<?php

namespace Modules\Task\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Task\DataTransferObjects\TaskDTO;
use Modules\Task\DataTransferObjects\TaskFilters;
use Modules\Task\DataTransferObjects\UpdateTaskDTO;
use Modules\Task\Enums\TaskPriority;
use Modules\Task\Enums\TaskStatus;
use Modules\Task\Models\Task;
use Modules\Task\Repositories\Contracts\TaskInterface;

class TaskRepository implements TaskInterface
{
    public function allByUser(int $userId, TaskFilters $filters): Collection
    {
        return $this->byUserQuery($userId)
            ->when($filters->status, fn (Builder $query, TaskStatus $status) => $query->where('status', $status))
            ->when($filters->priority, fn (Builder $query, TaskPriority $priority) => $query->where('priority', $priority))
            ->when($filters->title, fn (Builder $query, string $title) => $query->where('title', 'like', '%'.$title.'%'))
            ->get();
    }

    public function countByUser(int $userId, TaskFilters $filters): int
    {
        return $this->byUserQuery($userId)
            ->when($filters->status, fn (Builder $query, TaskStatus $status) => $query->where('status', $status))
            ->when($filters->priority, fn (Builder $query, TaskPriority $priority) => $query->where('priority', $priority))
            ->when($filters->title, fn(Builder $query, string $title) => $query->where('title', 'like', '%' . $title . '%'))
            ->count();
    }

    public function countPendingByUser(int $userId): int
    {
        return $this->byUserQuery($userId)
            ->where('status', '!=', TaskStatus::Done)
            ->count();
    }

    public function countOverdueByUser(int $userId): int
    {
        return $this->byUserQuery($userId)
            ->where('status', '!=', TaskStatus::Done)
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', now())
            ->count();
    }

    public function find(int $id): ?Task
    {
        return Task::find($id);
    }

    public function create(TaskDTO $data): Task
    {
        return Task::create($data->toArray());
    }

    public function update(Task $task, UpdateTaskDTO $data): Task
    {
        $task->update($data->toArray());

        return $task;
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }

    private function byUserQuery(int $userId): Builder
    {
        return Task::whereHas('project', function (Builder $query) use ($userId) {
            $query->where('user_id', $userId);
        });
    }
}
