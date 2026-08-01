<?php

namespace Modules\Task\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Task\Models\Task;
use Modules\Task\Repositories\Contracts\TaskInterface;

class TaskRepository implements TaskInterface
{
    public function allByUser(int $userId): Collection
    {
        return Task::whereHas('project', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    }
}
