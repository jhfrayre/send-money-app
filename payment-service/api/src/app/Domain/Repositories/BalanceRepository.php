<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\Repositories\BalanceRepositoryInterface;
use App\Domain\ValueObjects\UserId;
use \DateTimeInterface;
use Illuminate\Support\Facades\DB;

class BalanceRepository implements BalanceRepositoryInterface
{
    /**
     * @param UserId $userId
     * @return ?stdClass $data
     */
    public function findUserCurrentBalance(UserId $userId)
    {
        $data = DB::table('user_current_balance')
            ->select('id', 'user_id', 'balance', 'updated_at')
            ->where('user_id', '=', $userId->value())
            ->first();
        return $data;
    }

    public function updateUserCurrentBalance(UserId $userId, DateTimeInterface $now, float $balance)
    {
        $result = DB::table('user_current_balance')
            ->where('user_id', '=', $userId->value())
            ->update([
                'balance' => $balance,
                'updated_at' => $now->format('Y-m-d H:i:s')
            ]);
        return $result;
    }
}
