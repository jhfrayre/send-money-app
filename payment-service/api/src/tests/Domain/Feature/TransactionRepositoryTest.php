<?php

use App\Domain\Repositories\TransactionRepository;

use App\Domain\Contracts\Repositories\TransactionRepositoryInterface;

test('TransactionRepository is instantiable', function () {
    $transactionRepo = new TransactionRepository();
    expect($transactionRepo instanceof TransactionRepositoryInterface)->toBe(true);
});
