<?php

use App\Models\User;
use Modules\Project\Models\Project;
use Modules\Task\Models\Task;

test('authenticated user can delete a task on their own project', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);
    $task = Task::factory()->create(['project_id' => $project->id]);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->deleteJson(route('api.task.destroy', $task));

    $response->assertOk()->assertJson(['message' => 'Task deleted successfully']);

    $this->assertSoftDeleted('tasks', ['id' => $task->id]);
});

test('authenticated user cannot delete a task on another user\'s project', function () {
    $owner = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $owner->id]);
    $task = Task::factory()->create(['project_id' => $project->id]);

    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->deleteJson(route('api.task.destroy', $task));

    $response->assertStatus(403);

    $this->assertDatabaseHas('tasks', ['id' => $task->id, 'deleted_at' => null]);
});

test('deleting a non-existent task returns 404', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->deleteJson(route('api.task.destroy', 999));

    $response->assertStatus(404);
});

test('guest cannot delete a task', function () {
    $task = Task::factory()->create();

    $response = $this->deleteJson(route('api.task.destroy', $task));

    $response->assertStatus(401);
});
