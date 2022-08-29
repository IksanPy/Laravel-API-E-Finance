<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function register(RegisterAuthRequest $request, AuthService $AuthService)
    {
        $register = $AuthService->register($request->all());

        return ResponseFormatter::success('Register success', $register);
    }

    public function login(LoginAuthRequest $request, AuthService $AuthService)
    {
        $login = $AuthService->login($request->only(['email', 'password']));

        if (is_null($login))
            return ResponseFormatter::error('Unauthorized', null, 401);

        return ResponseFormatter::success('Login success', $login);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return ResponseFormatter::success('Logout success');
    }
}
