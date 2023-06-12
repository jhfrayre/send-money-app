<?php

use App\Models\User;
use function Pest\Laravel\{actingAs};

it('has API login page')->post('/api/login')
    ->assertStatus(401)
    ->assertJson(['message' => 'Invalid credentials']);

it('returns token upon successful login', function () {
    $response = $this->post('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password'
    ]);
    $response->assertOk();
    $content = $response->content();
    expect($content)->toBeJson();
    expect(json_decode($content), $associativeArray = true)->toHaveProperty('token');
});

test('authenticated user can access the dashboard', function () {
    $response = $this->post('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password'
    ]);
    $token = $response->getData('token'); // ['token' => 'eyj...']
    $this->withToken($token['token'])
        ->get('/api/user')
        ->assertOk();
});
