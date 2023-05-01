<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * 
     * @OA\POST(
     *      path="/api/register",
     *      summary="Register",
     *      description="membuat pengguna baru beserta tokennya",
     *      tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User registration data",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                      @OA\Property(property="name", type="string", example="John Doe"),
     *                      @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *                      @OA\Property(property="password", type="string", example="john123")
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="OK AJA"
     *     ),@OA\Response(
     *          response=422,
     *          description="OK AJA"
     *     )
     * )
     * 
     */
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
