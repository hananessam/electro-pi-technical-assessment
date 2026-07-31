<?php

use App\Models\User;

test('user can register with valid data', function () {
    $response = $this->postJson(route('api.auth.register'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertCreated()
        ->assertJsonStructure(['access_token', 'user' => ['name', 'email']])
        ->assertJsonPath('user.email', 'john@example.com');

    $this->assertDatabaseHas('users', [
        'email' => 'john@example.com',
        'name' => 'John Doe',
    ]);
});

test('user cannot register with an email that already exists', function () {
    $existingUser = User::factory()->create();

    $response = $this->postJson(route('api.auth.register'), [
        'name' => 'John Doe',
        'email' => $existingUser->email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

test('user cannot register when password confirmation does not match', function () {
    $response = $this->postJson(route('api.auth.register'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'password_confirmation' => 'different-password',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['password']);
});

test('register requires name, email and password', function () {
    $response = $this->postJson(route('api.auth.register'), []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'email', 'password']);
});
