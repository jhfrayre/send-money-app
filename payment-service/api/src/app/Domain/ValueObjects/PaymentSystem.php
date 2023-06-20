<?php

namespace App\Domain\ValueObjects;

use \InvalidArgumentException;
use \TypeError;

class PaymentSystem
{
    public const INSTAPAY = 1;
    public const PESONET = 2;
    public const THIS_SERVICE = 3;

    protected int $id;
    protected ?string $name;

    /**
     * @param int $id
     * @param ?string $name
     * @throws TypeError
     */
    public function __construct(int $id, ?string $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): ?string
    {
        return $this->name;
    }
}
