<?php

namespace Modules\Task\Database\Seeders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Modules\Project\Models\Project;
use Modules\Task\Enums\TaskPriority;
use Modules\Task\Enums\TaskStatus;
use Modules\Task\Models\Task;

class TaskDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::whereHas(
            'user',
            fn (Builder $query) => $query->whereIn('email', ['test@example.com', 'test2@example.com'])
        )->get();

        if ($projects->isEmpty()) {
            $projects = Project::factory()->count(2)->create();
        }

        foreach ($projects as $project) {
            Task::factory()->create([
                'project_id' => $project->id,
                'title' => 'Finish the design mockups',
                'status' => TaskStatus::Done,
                'priority' => TaskPriority::High,
                'due_date' => now()->subDays(5),
            ]);

            Task::factory()->create([
                'project_id' => $project->id,
                'title' => 'Fix the login page bug',
                'status' => TaskStatus::InProgress,
                'priority' => TaskPriority::High,
                'due_date' => now()->addDays(3),
            ]);

            Task::factory()->create([
                'project_id' => $project->id,
                'title' => 'Write API documentation',
                'status' => TaskStatus::Todo,
                'priority' => TaskPriority::Medium,
                'due_date' => now()->subDays(2),
            ]);

            Task::factory()->create([
                'project_id' => $project->id,
                'title' => 'Plan next sprint',
                'status' => TaskStatus::Todo,
                'priority' => TaskPriority::Low,
                'due_date' => null,
            ]);

            // A few more randomized tasks for volume.
            Task::factory()->count(3)->create(['project_id' => $project->id]);
        }

        // Tasks on other users' projects, so ownership scoping has something to be tested against.
        Task::factory()->count(10)->create();
    }
}
