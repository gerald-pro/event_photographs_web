<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function requestToken(Request $request): string
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        };
        if (!empty($request->fcm_token) && $request->fcm_token != $user->fcm_token) {
            $user->update(['fcm_token' => $request->fcm_token]);
        }
        return $user->createToken($request->device_name)->plainTextToken;
    }
}
