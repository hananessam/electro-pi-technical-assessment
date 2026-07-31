<?php

use App\Models\User;
use Modules\Project\Models\Project;

test('authenticated user can list only their own projects', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    Project::factory()->count(3)->create(['user_id' => $user->id]);
    Project::factory()->count(2)->create();

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson(route('api.project.index'));

    $response->assertOk()->assertJsonCount(3, 'data');
});

test('guest cannot list projects', function () {
    $response = $this->getJson(route('api.project.index'));

    $response->assertStatus(401);
});
