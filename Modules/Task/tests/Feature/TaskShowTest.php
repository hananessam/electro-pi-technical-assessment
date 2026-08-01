<?php

use App\Models\User;
use Modules\Project\Models\Project;
use Modules\Task\Models\Task;

test('authenticated user can view a task on their own project', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);
    $task = Task::factory()->create(['project_id' => $project->id]);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.task.show', $task));

    $response->assertOk()->assertJsonPath('data.id', $task->id);
});

test('authenticated user cannot view a task on another user\'s project', function () {
    $owner = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $owner->id]);
    $task = Task::factory()->create(['project_id' => $project->id]);

    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.task.show', $task));

    $response->assertStatus(403);
});

test('viewing a non-existent task returns 404', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.task.show', 999));

    $response->assertStatus(404);
});

test('guest cannot view a task', function () {
    $task = Task::factory()->create();

    $response = $this->getJson(route('api.task.show', $task));

    $response->assertStatus(401);
});
