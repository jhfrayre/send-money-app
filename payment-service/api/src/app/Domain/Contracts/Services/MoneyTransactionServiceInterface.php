<?php

namespace App\Domain\Contracts\Services;

use App\Domain\Entities\MoneyTransaction;
use App\Domain\Services\MoneyTransactionService;
use App\Domain\ValueObjects\{
    TransactionParticipant,
    UserId
};
use \DateTimeImmutable;

interface MoneyTransactionServiceInterface
{
    public function sendMoneyToUser(
        MoneyTransaction $senderTransaction,
        TransactionParticipant $senderDetails,
        DateTimeImmutable $now
    ): MoneyTransaction;

    public function sendMoneyViaBankTransfer(MoneyTransaction $transaction, DateTimeImmutable $now): MoneyTransaction;

    public function checkUserCurrentBalance(UserId $userId): array;
}
