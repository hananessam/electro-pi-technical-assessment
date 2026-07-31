<?php

namespace Modules\Auth\Services;

use Modules\Auth\Repositories\Contracts\AuthInterface;

class AuthService
{
    public function __construct(private AuthInterface $authRepository)
    {
    }

    public function login(array $data): ?array
    {
        $user = $this->authRepository->getUserByEmail($data['email']);

        if (!$user || !password_verify($data['password'], $user->password)) {
            return null;
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'access_token' => $token,
            'user' => $user,
        ];
    }
}