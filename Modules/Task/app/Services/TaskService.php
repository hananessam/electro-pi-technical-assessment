<?php

namespace Modules\Task\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Task\DataTransferObjects\TaskDTO;
use Modules\Task\Models\Task;
use Modules\Task\Repositories\Contracts\TaskInterface;

class TaskService
{
    public function __construct(private TaskInterface $taskRepository) {}

    public function listForUser(int $userId): Collection
    {
        return $this->taskRepository->allByUser($userId);
    }

    public function create(TaskDTO $data): Task
    {
        return $this->taskRepository->create($data);
    }
}
