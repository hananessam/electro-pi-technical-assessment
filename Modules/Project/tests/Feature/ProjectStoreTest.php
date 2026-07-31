<?php

use App\Models\User;

test('authenticated user can create a project', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson(route('api.project.store'), [
            'name' => 'New Project',
            'description' => 'A project description',
            'status' => 'active',
        ]);

    $response->assertCreated()
        ->assertJsonPath('data.name', 'New Project')
        ->assertJsonPath('data.status', 'active');

    $this->assertDatabaseHas('projects', [
        'name' => 'New Project',
        'user_id' => $user->id,
    ]);
});

test('creating a project assigns it to the authenticated user regardless of submitted user_id', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson(route('api.project.store'), [
            'name' => 'New Project',
            'user_id' => $otherUser->id,
        ]);

    $response->assertCreated();

    $this->assertDatabaseHas('projects', [
        'name' => 'New Project',
        'user_id' => $user->id,
    ]);
});

test('creating a project requires a name', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson(route('api.project.store'), []);

    $response->assertStatus(422)->assertJsonValidationErrors(['name']);
});

test('guest cannot create a project', function () {
    $response = $this->postJson(route('api.project.store'), ['name' => 'New Project']);

    $response->assertStatus(401);
});
