<?php

use App\Models\User;
use Modules\Project\Models\Project;

test('authenticated user can delete their own project', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->deleteJson(route('api.project.destroy', $project));

    $response->assertOk()->assertJson(['message' => 'Project deleted successfully']);

    $this->assertSoftDeleted('projects', ['id' => $project->id]);
});

test('authenticated user cannot delete another user\'s project', function () {
    $owner = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $owner->id]);

    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->deleteJson(route('api.project.destroy', $project));

    $response->assertStatus(403);

    $this->assertDatabaseHas('projects', ['id' => $project->id, 'deleted_at' => null]);
});

test('deleting a non-existent project returns 404', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->deleteJson(route('api.project.destroy', 999));

    $response->assertStatus(404);
});

test('guest cannot delete a project', function () {
    $project = Project::factory()->create();

    $response = $this->deleteJson(route('api.project.destroy', $project));

    $response->assertStatus(401);
});
