<?php

namespace App\Domain\Contracts\Repositories;

use App\Domain\ValueObjects\UserId;
use \DateTimeInterface;

interface UserRepositoryInterface
{
    public function findByEmail(string $email);

    public function logUserLogin(UserId $userId, DateTimeInterface $now);
}
