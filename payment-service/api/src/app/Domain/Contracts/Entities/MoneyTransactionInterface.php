<?php

namespace App\Domain\Contracts\Entities;

interface MoneyTransactionInterface
{
    public function isValid(): bool;
}
