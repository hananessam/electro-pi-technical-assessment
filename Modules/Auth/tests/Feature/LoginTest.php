<?php

use App\Models\User;

test('user can login with valid credentials', function () {
    $user = User::factory()->create([
        'password' => 'password',
    ]);

    $response = $this->postJson(route('api.auth.login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertOk()
        ->assertJsonStructure(['access_token', 'user' => ['name', 'email']])
        ->assertJsonPath('user.email', $user->email);
});

test('user cannot login with invalid password', function () {
    $user = User::factory()->create([
        'password' => 'password',
    ]);

    $response = $this->postJson(route('api.auth.login'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertStatus(401)
        ->assertJson(['message' => 'Invalid credentials']);
});

test('user cannot login with unknown email', function () {
    $response = $this->postJson(route('api.auth.login'), [
        'email' => 'unknown@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(401)
        ->assertJson(['message' => 'Invalid credentials']);
});

test('login requires email and password', function () {
    $response = $this->postJson(route('api.auth.login'), []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'password']);
});
