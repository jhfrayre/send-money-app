<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\Repositories\TransactionRepositoryInterface;
use App\Domain\Entities\MoneyTransaction;
use App\Domain\ValueObjects\UserId;
use \DateTimeImmutable;
use Illuminate\Support\Facades\DB;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function postTransaction(MoneyTransaction $transaction, DateTimeImmutable $now)
    {
        $isPosted = DB::table('user_transactions')
            ->insert([
                'user_id' => $transaction->userId()->value(),
                'payment_system_id' => $transaction->paymentSystem()->id(),
                'type' => $transaction->type(),
                'payee' => ($transaction->payee()) ? $transaction->payee()->toJson() : $transaction->payee(),
                'payer' => ($transaction->payer()) ? $transaction->payer()->toJson() : $transaction->payer(),
                'amount' => $transaction->amount(),
                'beginning_balance' => $transaction->beginningBalance(),
                'ending_balance' => $transaction->endingBalance(),
                'description' => $transaction->description(),
                'created_at' => $now->format('Y-m-d H:i:s'),
            ]);
        return $isPosted;
    }

    public function findLatestTransactions(UserId $userId, int $limit = 5): array
    {
        $data = DB::table('user_transactions')
            ->select(
                'id',
                'user_id',
                'payment_system_id',
                'type',
                'payee',
                'payer',
                'amount',
                'beginning_balance',
                'ending_balance',
                'description',
                'created_at'
            )->where('user_id', '=', $userId->value())
            ->latest()
            ->take($limit)
            ->get()
            ->toArray();
        return $data;
    }
}
