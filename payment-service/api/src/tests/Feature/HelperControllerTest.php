<?php

use App\Models\User;

it('sends financial institution data', function () {
    $response = $this->postJson('/api/login', [
        'username' => 'test@example.com',
        'password' => 'password'
    ]);
    $this->withToken($response->getData('token')['token'])
        ->getJson('/api/financial-institutions')
        ->assertStatus(200);
});

it('blocks unauthenticated user', function () {
    $this->getJson('/api/financial-institutions')
        ->assertStatus(401);
});
