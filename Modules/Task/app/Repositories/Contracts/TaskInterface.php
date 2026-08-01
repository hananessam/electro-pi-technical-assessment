<?php

namespace Modules\Task\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Modules\Task\DataTransferObjects\TaskDTO;
use Modules\Task\DataTransferObjects\TaskFilters;
use Modules\Task\DataTransferObjects\UpdateTaskDTO;
use Modules\Task\Models\Task;

interface TaskInterface
{
    public function allByUser(int $userId, TaskFilters $filters): Collection;

    public function find(int $id): ?Task;

    public function create(TaskDTO $data): Task;

    public function update(Task $task, UpdateTaskDTO $data): Task;

    public function delete(Task $task): void;
}
