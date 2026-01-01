<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\SaleCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Laravolt\Avatar\Facade as Avatar;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'                      => 'required|string|max:255',
            'country_code'              => 'nullable|string|max:5',
            'phone_number'              => 'required|string|max:15',
            'image'                     => 'nullable|image|max:2048',
            'password'                  => ['required', Password::min(8)],
            're_password'               => 'required|same:password',
            'sales_code'                => 'nullable|exists:sale_codes,name',
            'type'                 => 'required|string|in:user,merchant',
        ]);

        $country_code = $request->country_code ?? '+20';

        $matched = preg_match('/^\+201[0-9]{9}$/', $country_code . $request->phone_number);

        if (! $matched) {
            return response()->json([
                'message'                   => __('Invalid Phone Number'),
            ], 403);
        }

        if (User::where('country_code', $country_code)->where('phone_number', $request->phone_number)->exists()) {
            return response()->json([
                'message'                   => __('phone number already taken'),
            ], 403);
        }

        $image_path = '';
        if ($request->hasFile('image') && !$request->remove_image) {
            $image = $request->file('image');
            $image_path = $image->store('users', 'public');
        } else {
            $avatar = Avatar::create($request->name)->toBase64();
            $image_content = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatar));
            $filename = 'users/' . uniqid() . '.png';
            Storage::disk('public')->put($filename, $image_content);
            $image_path = $filename;
        }

        $sale_code = SaleCode::where('name', $request->sales_code)->first();

        $user = User::create([
            'name'                      => $request->name,
            'country_code'              => $country_code,
            'phone_number'              => $request->phone_number,
            'image'                     => $image_path,
            'password'                  => Hash::make($request->password),
            'sale_code_id'              => $sale_code ?$sale_code->id : null,
            'type'                      => $request->type,
        ]);

        $auth_token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'                   => __('User Registered Successfully'),
            'user'                      => new UserResource($user),
            'auth_token'                => $auth_token,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'country_code'                  => 'nullable|string|max:5',
            'phone_number'                  => 'required|string|max:15|exists:users,phone_number',
            'password'                      => 'required|min:8',
        ]);

        $country_code = $request->country_code ?? '+20';

        $user = User::where('country_code', $country_code)
            ->where('phone_number', $request->phone_number)
            ->first();

        if (!$user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message'                   => __('Invalid Phone Or Password'),
            ], 401);
        }

        if ($user->status != 'active') {
            return response()->json([
                'message'                   => __('User Banned By Admins'),
            ], 401);
        }

        $auth_token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'                   => __('logged in'),
            'user'                      => new UserResource($user),
            'auth_token'                => $auth_token,
        ]);
    }

    public function logout()
    {
        $user = Auth::guard('sanctum')->user();

        if (! $user) {
            return response()->json([
                'message'                   => __('Unauthenticated'),
            ], 401);
        }

        $user->currentAccessToken()->delete();

        return response()->json([
            'message'                   => __('Logged out'),
        ], 204);
    }

    public function updateTokens(Request $request)
    {
        $request->validate([
            'fcm_token'                     => 'required|string|max:255',
        ]);

        $user = Auth::guard('sanctum')->user();

        if (! $user) {
            return response()->json([
                'message'                   => __('Unauthenticated'),
            ], 401);
        }

        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json([
            'message'               => __('user tokens updated')
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $request->validate([
            'name'        => "sometimes|required|max:255",
            'image'       => 'sometimes|nullable|image|max:2048',
            'email'       => ['sometimes','email',Rule::unique('users','email')->ignore($user->id)],
            'password'    => ['sometimes', 'required', Password::min(8)],
            're_password' => 'sometimes|required_with:password|same:password',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('users', 'public');
            if ($user->image && !$this->isAvatarImage($user->image)) {
                Controller::deleteFile($user->image);
            }
            $user->image = $image_path;
        } elseif (is_null($request->image) && $this->isAvatarImage($user->image)) {
            $name = $request->name ?? $user->name;
            $avatar = Avatar::create($name)->toBase64();
            $image_content = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatar));
            $filename = 'users/' . uniqid() . '.png';
            Storage::disk('public')->put($filename, $image_content);
            $user->image = $filename;
        }

        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['message' => __('User updated')]);
    }

    private function isAvatarImage(string $imagePath): bool
    {
        return preg_match('/users\/[a-f0-9]{13,}\.png$/', $imagePath);
    }

    public function myQrcode()
    {
        $user = Auth::guard('sanctum')->user();

        return response()->json($user->qr_code);
    }

    public function myReferralCode()
    {
        $user = Auth::guard('sanctum')->user();

        return response()->json($user->referral_code);
    }

    public function user()
    {
        return new UserResource(Auth::guard('sanctum')->user());
    }

    public function deleteAccount()
    {
        $user = Auth::guard('sanctum')->user();

        if ($user->image) {
            Controller::deleteFile($user->image);
        }

        $user->delete();

        return response()->json(status: 204);
    }
}
