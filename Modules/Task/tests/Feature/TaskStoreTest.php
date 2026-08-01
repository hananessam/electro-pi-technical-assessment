<?php

use App\Models\User;
use Modules\Project\Models\Project;

test('authenticated user can create a task for their own project', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson(route('api.task.store'), [
            'project_id' => $project->id,
            'title' => 'New Task',
            'description' => 'A task description',
            'status' => 'in_progress',
            'priority' => 'high',
        ]);

    $response->assertCreated()
        ->assertJsonPath('data.title', 'New Task')
        ->assertJsonPath('data.status', 'in_progress')
        ->assertJsonPath('data.priority', 'high');

    $this->assertDatabaseHas('tasks', [
        'title' => 'New Task',
        'project_id' => $project->id,
    ]);
});

test('creating a task requires a status and priority', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson(route('api.task.store'), [
            'project_id' => $project->id,
            'title' => 'New Task',
        ]);

    $response->assertStatus(422)->assertJsonValidationErrors(['status', 'priority']);
});

test('authenticated user cannot create a task for another user\'s project', function () {
    $owner = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $owner->id]);

    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson(route('api.task.store'), [
            'project_id' => $project->id,
            'title' => 'New Task',
            'status' => 'todo',
            'priority' => 'medium',
        ]);

    $response->assertStatus(403);

    $this->assertDatabaseMissing('tasks', ['title' => 'New Task']);
});

test('creating a task requires a project_id, title, status, and priority', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson(route('api.task.store'), []);

    $response->assertStatus(422)->assertJsonValidationErrors(['project_id', 'title', 'status', 'priority']);
});

test('creating a task requires an existing project_id', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson(route('api.task.store'), [
            'project_id' => 999,
            'title' => 'New Task',
        ]);

    $response->assertStatus(422)->assertJsonValidationErrors(['project_id']);
});

test('guest cannot create a task', function () {
    $project = Project::factory()->create();

    $response = $this->postJson(route('api.task.store'), [
        'project_id' => $project->id,
        'title' => 'New Task',
    ]);

    $response->assertStatus(401);
});
