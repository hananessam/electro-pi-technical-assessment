<?php

use App\Models\User;
use Modules\Project\Models\Project;
use Modules\Task\Models\Task;

test('authenticated user can update a task on their own project', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);
    $task = Task::factory()->create(['project_id' => $project->id, 'title' => 'Old Title']);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson(route('api.task.update', $task), ['title' => 'Updated Title']);

    $response->assertOk()->assertJsonPath('data.title', 'Updated Title');

    $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => 'Updated Title']);
});

test('authenticated user can update a task\'s status and priority', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);
    $task = Task::factory()->create(['project_id' => $project->id, 'status' => 'todo', 'priority' => 'low']);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson(route('api.task.update', $task), ['status' => 'done', 'priority' => 'high']);

    $response->assertOk()
        ->assertJsonPath('data.status', 'done')
        ->assertJsonPath('data.priority', 'high');
});

test('authenticated user cannot update a task on another user\'s project', function () {
    $owner = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $owner->id]);
    $task = Task::factory()->create(['project_id' => $project->id, 'title' => 'Old Title']);

    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson(route('api.task.update', $task), ['title' => 'Updated Title']);

    $response->assertStatus(403);

    $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => 'Old Title']);
});

test('updating a task with an invalid status is rejected', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);
    $task = Task::factory()->create(['project_id' => $project->id]);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson(route('api.task.update', $task), ['status' => 'not-a-status']);

    $response->assertStatus(422)->assertJsonValidationErrors(['status']);
});

test('updating a non-existent task returns 404', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson(route('api.task.update', 999), ['title' => 'Updated Title']);

    $response->assertStatus(404);
});

test('guest cannot update a task', function () {
    $task = Task::factory()->create();

    $response = $this->putJson(route('api.task.update', $task), ['title' => 'Updated Title']);

    $response->assertStatus(401);
});
