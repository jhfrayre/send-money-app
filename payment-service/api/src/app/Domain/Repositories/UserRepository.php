<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\Repositories\UserRepositoryInterface;
use App\Domain\ValueObjects\UserId;
use \DateTimeInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @return int $lastInsertId
     */
    public function logUserLogin(UserId $userId, DateTimeInterface $now, bool $isSuccess = true)
    {
        $lastInsertId = DB::table('user_login_history')
            ->insertGetId([
                'user_id' => $userId->value(),
                'is_success' => $isSuccess,
                'created_at' => $now->format('Y-m-d H:i:s')
                ]
            );
        return $lastInsertId;
    }
}
