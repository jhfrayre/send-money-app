<?php

namespace App\Domain\Contracts\Repositories;

use App\Domain\ValueObjects\PaymentSystem;

interface HelperRepositoryInterface
{
    public function findACHParticipants(?PaymentSystem $paymentSystem);
}
