<?php

namespace Modules\Auth\Repositories\Contracts;

use App\Models\User;

interface AuthInterface
{
    public function getUserByEmail(string $email): ?User;
}
