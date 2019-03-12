<?php

declare(strict_types=1);

namespace Bingo\Shared\Domain\ValueObject;

/**
 * Class IntValueObject
 * @package Bingo\Shared\Domain\ValueObject
 */
class IntValueObject
{
    protected $value;

    /**
     * IntValueObject constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
}