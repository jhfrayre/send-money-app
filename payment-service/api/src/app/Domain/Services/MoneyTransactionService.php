<?php

namespace App\Domain\Services;

use App\Domain\Contracts\{
    Repositories\BalanceRepositoryInterface,
    Repositories\TransactionRepositoryInterface,
    Services\MoneyTransactionServiceInterface
};
use Illuminate\Support\Facades\DB;

class MoneyTransactionService implements MoneyTransactionServiceInterface
{
    protected $transactionRepo;
    protected $balanceRepo;

    public function __construct(
        TransactionRepositoryInterface $transactionRepo,
        BalanceRepositoryInterface $balanceRepo
    ) {
        $this->transactionRepo = $transactionRepo;
        $this->balanceRepo = $balanceRepo;
    }

    public function sendMoneyToUser(MoneyTransaction $transaction)
    {

    }

    public function sendMoneyViaBankTransfer()
    {

    }

    public function checkUserCurrentBalance(UserId $userId): array
    {
        $data = $this->balanceRepo->findUserCurrentBalance($userId);
        return $data;
    }
}
