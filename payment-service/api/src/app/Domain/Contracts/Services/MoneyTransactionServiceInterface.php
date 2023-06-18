<?php

namespace App\Domain\Contracts\Services;

use App\Domain\Services\MoneyTransactionService;
use App\Domain\ValueObjects\UserId;

interface MoneyTransactionServiceInterface
{
    public function checkUserCurrentBalance(UserId $userId): array;
}
