<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register($request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $data['user'] = $user;
        $data['token_type'] = 'Bearer';
        $data['token'] = $token;

        return $data;
    }

    public function login($request)
    {
        $data = null;

        if (!Auth::attempt($request))
            return $data;

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        $data['user'] = $user;
        $data['token_type'] = 'Bearer';
        $data['token'] = $token;

        return $data;
    }
}
