<?php

use App\Domain\Contracts\Entities\MoneyTransactionInterface;
use App\Domain\Entities\MoneyTransaction;
use App\Domain\ValueObjects\{PaymentSystem, UserId};

test('MoneyTransaction is instantiable', function () {
    $transaction = new MoneyTransaction(
        UserId::make(1),
        new PaymentSystem(1, 'InstaPay'),
        new DateTimeImmutable('now'),
        0,
        0,
        MoneyTransaction::CREDIT
    );
    expect($transaction instanceof MoneyTransactionInterface)->toBe(true);
});

test('MoneyTransaction status() returns', function () {
    $transaction = new MoneyTransaction(
        UserId::make(1),
        new PaymentSystem(1, 'InstaPay'),
        new DateTimeImmutable('now'),
        0,
        0,
        MoneyTransaction::CREDIT
    );
    expect($transaction->status())->toBeInt()->toBe(MoneyTransaction::POSTED);
    expect($transaction->isValid())->toBe(false);
    expect($transaction->status())->toBeInt()->toBe(MoneyTransaction::VOID);
});

test('MoneyTransaction validation', function () {
    $userId = UserId::make(1);
    $paymentSystem = new PaymentSystem(1, 'InstaPay');
    $postedAt = new DateTimeImmutable('now');

    // Transaction with ₱0 amount
    $transaction = new MoneyTransaction(
        $userId,
        $paymentSystem,
        $postedAt,
        100,
        0,
        MoneyTransaction::DEBIT
    );
    expect($transaction->isValid())->toBe(false);

    // Deposit ₱10 to ₱0 account balance
    $transaction = new MoneyTransaction(
        $userId,
        $paymentSystem,
        $postedAt,
        0,
        10,
        MoneyTransaction::DEBIT
    );
    expect($transaction->isValid())->toBe(true);

    // Withdraw ₱10 from ₱0 account balance
    $transaction = new MoneyTransaction(
        $userId,
        $paymentSystem,
        $postedAt,
        0,
        10,
        MoneyTransaction::CREDIT
    );
    expect($transaction->isValid())->toBe(false);

    // Withdraw ₱100 from ₱100 account balance
    $transaction = new MoneyTransaction(
        $userId,
        $paymentSystem,
        $postedAt,
        100,
        100,
        MoneyTransaction::CREDIT
    );
    expect($transaction->isValid())->toBe(true);
});

test('MoneyTransaction endingBalance computations', function () {
    $userId = UserId::make(1);
    $paymentSystem = new PaymentSystem(1, 'InstaPay');
    $postedAt = new DateTimeImmutable('now');

    // Deposit ₱10 to ₱0 account balance
    $transaction = new MoneyTransaction(
        $userId,
        $paymentSystem,
        $postedAt,
        0,
        10,
        MoneyTransaction::DEBIT
    );
    expect($transaction->endingBalance())->toBe(10.0);

    // Withdraw ₱100 from ₱100 account balance
    $transaction = new MoneyTransaction(
        $userId,
        $paymentSystem,
        $postedAt,
        100,
        100,
        MoneyTransaction::CREDIT
    );
    expect($transaction->endingBalance())->toBe(0.0);
});

test('Invalid transaction throws error', function () {
    $userId = UserId::make(1);
    $paymentSystem = new PaymentSystem(1, 'InstaPay');
    $postedAt = new DateTimeImmutable('now');

    // Withdraw ₱10 from ₱0 account balance
    $transaction = new MoneyTransaction(
        $userId,
        $paymentSystem,
        $postedAt,
        0,
        10,
        MoneyTransaction::CREDIT
    );
    $endingBalance = $transaction->endingBalance();
})->throws(TypeError::class);
