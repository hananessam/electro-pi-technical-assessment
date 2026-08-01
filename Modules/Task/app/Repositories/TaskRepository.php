<?php

namespace Modules\Task\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Task\DataTransferObjects\TaskDTO;
use Modules\Task\Models\Task;
use Modules\Task\Repositories\Contracts\TaskInterface;

class TaskRepository implements TaskInterface
{
    public function allByUser(int $userId): Collection
    {
        return Task::whereHas('project', function (Builder $query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    }

    public function create(TaskDTO $data): Task
    {
        return Task::create($data->toArray());
    }
}
