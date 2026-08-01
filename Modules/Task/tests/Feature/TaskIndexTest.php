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

test('authenticated user can filter tasks by status', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);
    Task::factory()->create(['project_id' => $project->id, 'status' => 'done']);
    Task::factory()->create(['project_id' => $project->id, 'status' => 'todo']);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.task.index', ['status' => 'done']));

    $response->assertOk()->assertJsonCount(1)->assertJsonPath('0.status', 'done');
});

test('authenticated user can filter tasks by priority', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);
    Task::factory()->create(['project_id' => $project->id, 'priority' => 'high']);
    Task::factory()->create(['project_id' => $project->id, 'priority' => 'low']);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.task.index', ['priority' => 'high']));

    $response->assertOk()->assertJsonCount(1)->assertJsonPath('0.priority', 'high');
});

test('authenticated user can search tasks by title', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);
    Task::factory()->create(['project_id' => $project->id, 'title' => 'Design the homepage']);
    Task::factory()->create(['project_id' => $project->id, 'title' => 'Fix login bug']);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.task.index', ['title' => 'homepage']));

    $response->assertOk()->assertJsonCount(1)->assertJsonPath('0.title', 'Design the homepage');
});

test('filtering tasks by an invalid status is rejected', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.task.index', ['status' => 'not-a-status']));

    $response->assertStatus(422)->assertJsonValidationErrors(['status']);
});

test('guest cannot list tasks', function () {
    $response = $this->getJson(route('api.task.index'));

    $response->assertStatus(401);
});
