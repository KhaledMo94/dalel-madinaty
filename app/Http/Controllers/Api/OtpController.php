<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class OtpController extends Controller
{
    public function resetPassword(Request $request)
    {
        $request->validate([
            'country_code'    => 'required|string|max:5',
            'phone_number'    => 'required|string|max:15',
            'otp'             => 'required|digits:5',
            'password'        => 'required|string|min:8',
        ]);

        $user = User::where('country_code', $request->country_code)
            ->where('phone_number', $request->phone_number)
            ->first();

        if (! $user || $user->otp_code !== $request->otp || now()->gt($user->otp_expires_at)) {
            return response()->json([
                'message' => __('Invalid or expired OTP.'),
            ], 403);
        }

        $user->password = bcrypt($request->password);
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        return response()->json([
            'message'                       => __('Password has been reset successfully.'),
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'country_code'              => 'required|string|max:5',
            'phone_number'              => 'required|string|max:15',
        ]);

        $user = User::where('country_code', $request->country_code)
            ->where('phone_number', $request->phone_number)->first();
            
        if(! $user){
            return response()->json([
                'message'               =>__('Wrong Phone Number'),
            ],401);
        }

        $otp = random_int(10000, 99999);

        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        $beon_token = env('BEON_TOKEN');

        $body = array();
        $body['phoneNumber'] = $user->phone;
        $body['name'] = 'test';
        $body['type'] = 'sms';
        $body['otp_length'] = 5;
        $body['lang'] = app()->getLocale();
        $body['reference'] = '123';
        $body['custom_code'] = $otp;

        $response = Http::withHeaders([
            'beon-token' => $beon_token,
        ])->withBody(json_encode($body))
            ->post('https://v3.api.beon.chat/api/v3/messages/otp');

        return response()->json([
            'message' => 'OTP sent',
        ]);

    }

    public function send(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if ($user->phone_verified_at) {
            return response()->json([
                'message'                   => __('Your Phone Is Verified')
            ], 401);
        }
        $otp = random_int(10000, 99999);

        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        $beon_token = env('BEON_TOKEN');

        $body = array();
        $body['phoneNumber'] = $user->phone;
        $body['name'] = 'test';
        $body['type'] = 'sms';
        $body['otp_length'] = 5;
        $body['lang'] = app()->getLocale();
        $body['reference'] = '123';
        $body['custom_code'] = $otp;

        $response = Http::withHeaders([
            'beon-token' => $beon_token,
        ])->withBody(json_encode($body))
            ->post('https://v3.api.beon.chat/api/v3/messages/otp');

        return response()->json([
            'message' => 'OTP sent',
            // 'api_response' => $response->body()
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code'                  => 'required|numeric|between:10000,99999'
        ]);

        $user = Auth::guard('sanctum')->user();

        if ($user->otp_expires_at < now()) {
            return response()->json([
                'message'                   => __('Expired Code')
            ], 401);
        }

        if ($user->otp_code != $request->code) {
            return response()->json([
                'message'                   => __('Invalid Code')
            ], 401);
        }

        $user->phone_verified_at = now();
        $user->save();

        return response()->json([
            'message'               => __('Phone verified succesfully')
        ]);
    }
}
