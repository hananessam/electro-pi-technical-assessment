<?php

namespace Modules\Auth\Repositories\Contracts;

use App\Models\User;

interface AuthInterface
{
    public function getUserByEmail(string $email): ?User;

    /**
     * @param  array{name: string, email: string, password: string}  $data
     */
    public function createUser(array $data): User;
}
