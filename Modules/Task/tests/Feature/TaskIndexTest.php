<?php

use App\Models\User;
use Modules\Project\Models\Project;
use Modules\Task\Models\Task;

test('authenticated user can list only tasks on their own projects', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);
    Task::factory()->count(3)->create(['project_id' => $project->id]);

    $otherProject = Project::factory()->create();
    Task::factory()->count(2)->create(['project_id' => $otherProject->id]);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.task.index'));

    $response->assertOk()->assertJsonCount(3);
});

test('guest cannot list tasks', function () {
    $response = $this->getJson(route('api.task.index'));

    $response->assertStatus(401);
});
