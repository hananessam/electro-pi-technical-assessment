<?php

namespace Modules\Task\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Modules\Task\DataTransferObjects\TaskDTO;
use Modules\Task\Models\Task;

interface TaskInterface
{
    public function allByUser(int $userId): Collection;

    public function create(TaskDTO $data): Task;
}
