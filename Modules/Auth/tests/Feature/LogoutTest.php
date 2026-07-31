<?php

use App\Models\User;

test('authenticated user can logout', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->postJson(route('api.auth.logout'));

    $response->assertOk()
        ->assertJson(['message' => 'Logged out successfully']);

    $this->assertDatabaseCount('personal_access_tokens', 0);
});

test('guest cannot logout', function () {
    $response = $this->postJson(route('api.auth.logout'));

    $response->assertStatus(401);
});
