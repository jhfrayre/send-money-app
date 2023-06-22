<?php

beforeEach(function () {
    $response = $this->postJson('/api/login', [
        'username' => 'test@example.com',
        'password' => 'password'
    ]);
    $this->userToken = $response->getData('token'); // ['token' => 'eyj...']
});

it('blocks unauthenticated user', function () {
    $this->getJson('/api/transaction-history')
        ->assertStatus(401);
    $this->postJson('/api/send-money', [])
        ->assertStatus(401);
    $this->postJson('/api/bank-transfer', [])
        ->assertStatus(401);
});

it('has transaction history', function () {
    $this->withToken($this->userToken['token'])
        ->getJson('/api/transaction-history')
        ->assertStatus(200);
});

it('cannot send money with balance less than the amount', function () {
    $this->withToken($this->userToken['token'])
        ->postJson('/api/send-money', [
            'email' => 'test2@example.com',
            'amount' => '1000.01'
        ])->assertStatus(409);
});

it('sends money to user2', function () {
    $this->withToken($this->userToken['token'])
        ->postJson('/api/send-money', [
            'email' => 'test2@example.com',
            'amount' => '500.72'
        ])->assertStatus(200);
});

it ('send back money to user', function () {
    $user2Login = $this->postJson('/api/login', [
        'username' => 'test2@example.com',
        'password' => 'password'
    ])->getData('token');
    $this->withToken($user2Login['token'])
        ->postJson('/api/send-money', [
            'email' => 'test@example.com',
            'amount' => '500.72'
        ])->assertStatus(200);
});

it('sends money via bank transfer', function () {
    $this->withToken($this->userToken['token'])
        ->postJson('/api/bank-transfer', [
            'amount' => '367.51',
            'payment_system_id' => '1',
            'payment_system_name' => 'InstaPay',
            'recipient' => [
                'bank' => [
                    'financial_institution_id' => 8,
                    'bank_name' => 'Bank of the Philippine Islands',
                    'account_number' => '123456789',
                    'account_name' => 'Bank Transfer Recipient',
                ]
            ],
        ])->assertStatus(200);
})->skip('A manual data refresh is required for this test'); //Refresh database is not yet implemented
