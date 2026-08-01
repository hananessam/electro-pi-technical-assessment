<?php

namespace Modules\Task\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface TaskInterface
{
    public function allByUser(int $userId): Collection;
}
