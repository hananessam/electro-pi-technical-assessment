<?php

use App\Models\User;
use Modules\Project\Models\Project;
use Modules\Task\Models\Task;

test('authenticated user gets a dashboard summary scoped to their own projects and tasks', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $activeProject = Project::factory()->create(['user_id' => $user->id, 'status' => 'active']);
    Project::factory()->create(['user_id' => $user->id, 'status' => 'completed']);

    Task::factory()->create(['project_id' => $activeProject->id, 'status' => 'done', 'due_date' => now()->subDay()]);
    Task::factory()->create(['project_id' => $activeProject->id, 'status' => 'todo', 'due_date' => now()->subDay()]);
    Task::factory()->create(['project_id' => $activeProject->id, 'status' => 'in_progress', 'due_date' => now()->addDay()]);
    Task::factory()->create(['project_id' => $activeProject->id, 'status' => 'todo', 'due_date' => null]);

    $otherProject = Project::factory()->create();
    Task::factory()->count(2)->create(['project_id' => $otherProject->id]);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.dashboard'));

    $response->assertOk()->assertExactJson([
        'total_projects' => 2,
        'active_projects' => 1,
        'total_tasks' => 4,
        'completed_tasks' => 1,
        'pending_tasks' => 3,
        'overdue_tasks' => 1,
    ]);
});

test('guest cannot view the dashboard', function () {
    $response = $this->getJson(route('api.dashboard'));

    $response->assertStatus(401);
});
