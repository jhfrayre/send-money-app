<?php declare(strict_types = 1);

namespace App\Domain\ValueObjects;

use \InvalidArgumentException;
use \TypeError;

class UserId
{
    protected $id;

    /**
     * Please use the static make() method instead
     * @param int $id
     * @return UserId
     * @throws TypeError
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param int $id
     * @return UserId
     * @throws InvalidArgumentException
     */
    public static function make($id)
    {
        if (is_int($id)) {
            return new self($id);
        } else {
            throw new InvalidArgumentException();
        }
    }

    public function value(): int
    {
        return $this->id;
    }
}
