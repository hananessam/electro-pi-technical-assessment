<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Transformers\UserResource;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService)
    {
    }

    public function login(LoginRequest $request)
    {
        $authData = $this->authService->login($request->validated());

        if (!$authData) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'access_token' => $authData['access_token'],
            'user' => new UserResource($authData['user']),
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $authData = $this->authService->register($request->validated());

        return response()->json([
            'access_token' => $authData['access_token'],
            'user' => new UserResource($authData['user']),
        ], 201);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->json(['message' => 'Logged out successfully']);
    }
}
