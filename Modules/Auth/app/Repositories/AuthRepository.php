<?php

namespace Modules\Auth\Repositories;

use App\Models\User;
use Modules\Auth\Repositories\Contracts\AuthInterface;

class AuthRepository implements AuthInterface
{
    public function getUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function createUser(array $data): User
    {
        return User::create($data);
    }
}
