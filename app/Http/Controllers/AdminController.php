<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Permission;
use Laravolt\Avatar\Facade as Avatar;


class AdminController extends Controller
{
    public function index()
    {
        $users = User::role('admin')->with('permissions')->get();
        return view('admin.admins.index',compact('users'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.admins.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|max:255|unique:users,email',
            'password'              => ['required', Password::min(8)],
            'password_confirmation' => 'required|same:password',
            'status'                => 'required|in:active,inactive',
            'permissions'           => 'required|array|min:1',
            'permissions.*'         => 'required|exists:permissions,id',
            'image'                 => 'nullable|image|max:5120',
        ]);

        $image_path = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('users', 'public');
        } else {
            $avatar = Avatar::create($request->name)->toBase64();
            $image_content = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatar));
            $filename = 'users/' . uniqid() . '.png';
            Storage::disk('public')->put($filename, $image_content);
            $image_path = $filename;
        }

        $user = User::create([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'image'                 => $image_path,
            'status'                => $request->status,
            'email_verified_at'     => now(),
            'phone_verified_at'     => now(),
            'password'              => Hash::make($request->password),
        ]);

        // Assign multiple permissions (convert IDs to Permission models)
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $user->syncPermissions($permissions);
        $user->assignRole('admin');

        return redirect()->route('admins.admins.index')
            ->with('success', __('Admin Created Successfully'));
    }

    public function edit(User $admin)
    {
        $permissions = Permission::all();
        return view('admin.admins.edit',compact('permissions','admin'));
    }

    public function update(Request $request , User $admin)
    {
        $request->validate([
            'name'                      =>'required|string|max:255',
            'email'                     =>['required','email','max:255',Rule::unique('users','email')->ignore($admin->id)],
            'password'                  =>['nullable','required_with:password_confirmation',Password::min(8)],
            'password_confirmation'     =>'nullable|required_with:password|same:password',
            'status'                    => 'required|in:active,inactive',
            'permissions'               => 'required|array|min:1',
            'permissions.*'             => 'required|exists:permissions,id',
            'image'                     =>'nullable|image|max:5120',
        ]);

        $image_path = $admin->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_path = $image->store('users', 'public');
            if ($admin->image && !$this->isAvatarImage($admin->image)) {
                Controller::deleteFile($admin->image);
            }
            $admin->image = $image_path;
        } elseif (is_null($request->image) && $this->isAvatarImage($admin->image)) {
            $name = $request->name ?? $admin->name;
            $avatar = Avatar::create($name)->toBase64();
            $image_content = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatar));
            $filename = 'admins/' . uniqid() . '.png';
            Storage::disk('public')->put($filename, $image_content);
            $admin->image = $filename;
        }

        $updateData = [
            'name'      => $request->name,
            'email'     => $request->email,
            'status'    => $request->status,
            'image'     => $image_path,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $admin->update($updateData);

        // Sync multiple permissions (convert IDs to Permission models)
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $admin->syncPermissions($permissions);

        return redirect()->route('admins.admins.index')
        ->with('success',__('Admin Updated Successfully'));

    }
    
    public function destroy(User $admin)
    {
        if ($admin->image) {
            Controller::deleteFile($admin->image);
        }
        $admin->delete();
        return redirect()->route('admins.admins.index')
            ->with('success', __('Admin Deleted Successfully'));
    }

    public function toggleStatus($id)
    {
        $admin = User::role('admin')->findOrFail($id);

        $admin->status = $admin->status == 'active' ? 'inactive' : 'active';
        $admin->save();

        $admin->tokens()->delete();

        return response()->json([
            'message' => 'Status updated successfully',
        ]);
    }

    private function isAvatarImage(string $imagePath): bool
    {
        return preg_match('/users\/[a-f0-9]{13,}\.png$/', $imagePath);
    }
}
