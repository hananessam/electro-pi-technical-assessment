<?php

use App\Models\User;
use Modules\Project\Models\Project;

test('authenticated user can view their own project', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $project = Project::factory()->create(['user_id' => $user->id]);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.project.show', $project));

    $response->assertOk()->assertJsonPath('data.id', $project->id);
});

test('authenticated user cannot view another user\'s project', function () {
    $owner = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $owner->id]);

    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.project.show', $project));

    $response->assertStatus(403);
});

test('viewing a non-existent project returns 404', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.project.show', 999));

    $response->assertStatus(404);
});

test('guest cannot view a project', function () {
    $project = Project::factory()->create();

    $response = $this->getJson(route('api.project.show', $project));

    $response->assertStatus(401);
});
