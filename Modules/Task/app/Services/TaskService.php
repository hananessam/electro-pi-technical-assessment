<?php

namespace Modules\Task\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Task\DataTransferObjects\TaskDTO;
use Modules\Task\DataTransferObjects\TaskFilters;
use Modules\Task\DataTransferObjects\UpdateTaskDTO;
use Modules\Task\Models\Task;
use Modules\Task\Repositories\Contracts\TaskInterface;

class TaskService
{
    public function __construct(private TaskInterface $taskRepository) {}

    public function listForUser(int $userId, TaskFilters $filters): Collection
    {
        return $this->taskRepository->allByUser($userId, $filters);
    }

    public function find(int $id): ?Task
    {
        return $this->taskRepository->find($id);
    }

    public function create(TaskDTO $data): Task
    {
        return $this->taskRepository->create($data);
    }

    public function update(Task $task, UpdateTaskDTO $data): Task
    {
        return $this->taskRepository->update($task, $data);
    }

    public function delete(Task $task): void
    {
        $this->taskRepository->delete($task);
    }
}
