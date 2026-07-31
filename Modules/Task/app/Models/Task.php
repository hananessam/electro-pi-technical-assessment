<?php

namespace Modules\Task\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Project\Models\Project;
use Modules\Task\Database\Factories\TaskFactory;
use Modules\Task\Enums\TaskPriority;
use Modules\Task\Enums\TaskStatus;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'priority',
        'status',
        'due_date',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'due_date' => 'date',
        'priority' => TaskPriority::class,
        'status' => TaskStatus::class,
    ];

    /**
     * Get the project that owns the task.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected static function newFactory(): TaskFactory
    {
        return TaskFactory::new();
    }
}
