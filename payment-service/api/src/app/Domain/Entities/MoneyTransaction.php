<?php

namespace App\Domain\Entities;

use App\Domain\Contracts\Entities\MoneyTransactionInterface;
use App\Domain\ValueObjects\{
    PaymentSystem,
    TransactionParticipant,
    UserId
};
use \DateTimeImmutable;

class MoneyTransaction implements MoneyTransactionInterface
{
    public const CREDIT = -1;
    public const DEBIT = 1;

    public const VOID = 0;
    public const POSTED = 1;
    public const VALIDATED = 2;
    public const COMPLETED = 3;

    protected int $transactionId;
    protected UserId $userId;
    protected PaymentSystem $paymentSystem;
    protected float $beginningBalance;
    protected float $amount;
    protected int $type;
    protected int $status = self::POSTED;
    protected ?TransactionParticipant $payee = null;
    protected ?TransactionParticipant $payer = null;
    protected ?string $description = null;
    protected DateTimeImmutable $postedAt;
    protected ?DateTimeImmutable $completedAt = null;

    public function __construct(
        UserId $userId,
        PaymentSystem $paymentSystem,
        DateTimeImmutable $postedAt,
        float $beginningBalance,
        float $amount,
        int $type
    ) {
        $this->userId = $userId;
        $this->paymentSystem = $paymentSystem;
        $this->postedAt = $postedAt;
        $this->beginningBalance = $beginningBalance;
        $this->amount = $amount;
        $this->type = $type;
    }

    public function isValid(): bool
    {
        if ($this->amount === (float) 0) {
            $status = self::VOID;
        } else {
            switch ($this->type) {
                case self::CREDIT:
                    $status = ($this->beginningBalance >= $this->amount) ? self::VALIDATED : self::VOID;
                    break;
                case self::DEBIT:
                    $status = self::VALIDATED;
                    break;
            }
        }

        if (in_array($this->status, [self::VOID, self::POSTED])) {
            $this->status = $status;
        }
        return $this->status === self::VALIDATED;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function postedAt(): DateTimeImmutable
    {
        return $this->postedAt;
    }

    public function beginningBalance(): float
    {
        return $this->beginningBalance;
    }

    /**
     * @return float $endingBalance
     * @throws TypeError when isValid() === false
     */
    public function endingBalance(): float
    {
        if ($this->isValid()) {
            if ($this->type === self::CREDIT) {
                return $this->beginningBalance() - $this->amount();

            } elseif ($this->type === self::DEBIT) {
                return $this->beginningBalance() + $this->amount();
            }
        }
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function type(): int
    {
        return $this->type;
    }

    public function paymentSystem(): PaymentSystem
    {
        return $this->paymentSystem;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function payee(): ?TransactionParticipant
    {
        return $this->payee;
    }

    public function setPayee(TransactionParticipant $payee)
    {
        $this->payee = $payee;
    }

    public function payer(): ?TransactionParticipant
    {
        return $this->payer;
    }

    public function setPayer(TransactionParticipant $payer)
    {
        $this->payer = $payer;
    }

    public function completedAt(): ?DateTimeImmutable
    {
        return $this->completedAt;
    }

    public function setCompletedAt(DateTimeImmutable $completedAt)
    {
        $this->completedAt = $completedAt;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }
}
