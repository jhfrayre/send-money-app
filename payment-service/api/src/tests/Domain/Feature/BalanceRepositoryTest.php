<?php

use App\Domain\Contracts\Repositories\BalanceRepositoryInterface;
use App\Domain\Repositories\BalanceRepository;
use App\Domain\ValueObjects\UserId;
use Tests\TestCase;

uses(TestCase::class);

test('BalanceRepository is instantiable', function () {
    $balanceRepo = new BalanceRepository();
    expect($balanceRepo instanceof BalanceRepositoryInterface)->toBe(true);
});

test('findUserCurrentBalance', function () {
    $userId = UserId::make(11);
    $balanceRepo = new BalanceRepository();
    $data = $balanceRepo->findUserCurrentBalance($userId);
    expect($data)->toBeObject();
    expect((float) $data->{'balance'})->toBe(1000.00);
});

test('updateUserCurrentBalance', function () {
    $userId = UserId::make(11);
    $now = new DateTimeImmutable('now');
    $balanceRepo = new BalanceRepository();
    $result = $balanceRepo->updateUserCurrentBalance($userId, $now, 1000.57);
    expect($result)->toBeInt()->toBe(1);

    $data = $balanceRepo->findUserCurrentBalance($userId);
    expect((float) $data->{'balance'})->toBe(1000.57);

    $result = $balanceRepo->updateUserCurrentBalance($userId, $now, 1000.00);
    $data = $balanceRepo->findUserCurrentBalance($userId);
    expect((float) $data->{'balance'})->toBe(1000.00);
});
