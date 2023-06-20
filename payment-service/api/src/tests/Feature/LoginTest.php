<?php

use App\Models\User;

it('has API login page')->post('/api/login')
    ->assertStatus(401)
    ->assertJson(['message' => 'Invalid credentials']);

it('returns token upon successful login', function () {
    $response = $this->postJson('/api/login', [
        'username' => 'test@example.com',
        'password' => 'password'
    ]);
    $response->assertStatus(200);
    $content = $response->content();
    expect($content)->toBeJson();
    expect(json_decode($content), $associativeArray = true)->toHaveProperty('token');
});

test('authenticated user can access the dashboard', function () {
    $response = $this->postJson('/api/login', [
        'username' => 'test@example.com',
        'password' => 'password'
    ]);
    $token = $response->getData('token'); // ['token' => 'eyj...']
    $this->withToken($token['token'])
        ->get('/api/user')
        ->assertStatus(200);
});

it('prevents access when inputting wrong password')
    ->postJson('/api/login', [
        'username' => 'test@example.com',
        'password' => 'wrong_password'
        ]
    )->assertStatus(401)
    ->assertJson(['message' => 'Invalid credentials']);

it('prevents access to unauthenticated user', function () {
    $response = $this->getJson('/api/user')
        ->assertStatus(401)
        ->assertJson(['message' => 'Unauthenticated.']);
});

it('can logout', function () {
    $response = $this->postJson('/api/login', [
        'username' => 'test@example.com',
        'password' => 'password'
    ]);
    $token = $response->getData('token');
    $this->withToken($token['token'])
        ->post('/api/logout')
        ->assertStatus(200);
});
