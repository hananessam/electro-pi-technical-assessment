<?php

use App\Models\User;
use Modules\Project\Models\Project;

test('authenticated user can update their own project', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id, 'name' => 'Old Name']);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson(route('api.project.update', $project), ['name' => 'Updated Name']);

    $response->assertOk()->assertJsonPath('data.name', 'Updated Name');

    $this->assertDatabaseHas('projects', ['id' => $project->id, 'name' => 'Updated Name']);
});

test('authenticated user cannot update another user\'s project', function () {
    $owner = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $owner->id, 'name' => 'Old Name']);

    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson(route('api.project.update', $project), ['name' => 'Updated Name']);

    $response->assertStatus(403);

    $this->assertDatabaseHas('projects', ['id' => $project->id, 'name' => 'Old Name']);
});

test('updating a non-existent project returns 404', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson(route('api.project.update', 999), ['name' => 'Updated Name']);

    $response->assertStatus(404);
});

test('guest cannot update a project', function () {
    $project = Project::factory()->create();

    $response = $this->putJson(route('api.project.update', $project), ['name' => 'Updated Name']);

    $response->assertStatus(401);
});
