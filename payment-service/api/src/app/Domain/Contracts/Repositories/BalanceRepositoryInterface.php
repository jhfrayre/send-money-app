<?php

namespace App\Domain\Contracts\Repositories;

use App\Domain\ValueObjects\UserId;

interface BalanceRepositoryInterface
{
    /**
     * @param UserId $userId
     * @return ?stdClass $data
     */
    public function findUserCurrentBalance(UserId $userId);
}
