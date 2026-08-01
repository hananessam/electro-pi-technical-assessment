<?php

namespace Modules\Task\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Task\DataTransferObjects\TaskDTO;
use Modules\Task\DataTransferObjects\TaskFilters;
use Modules\Task\DataTransferObjects\UpdateTaskDTO;
use Modules\Task\Models\Task;

interface TaskInterface
{
    public function allByUser(int $userId, TaskFilters $filters, int $perPage = 15): LengthAwarePaginator;

    public function countByUser(int $userId, TaskFilters $filters): int;

    public function countPendingByUser(int $userId): int;

    public function countOverdueByUser(int $userId): int;

    public function find(int $id): ?Task;

    public function create(TaskDTO $data): Task;

    public function update(Task $task, UpdateTaskDTO $data): Task;

    public function delete(Task $task): void;
}
