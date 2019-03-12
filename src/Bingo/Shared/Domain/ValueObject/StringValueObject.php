<?php

declare(strict_types=1);

namespace Bingo\Shared\Domain\ValueObject;

/**
 * Class StringValueObject
 * @package Bingo\Shared\Domain\ValueObject
 */
class StringValueObject
{
    protected $value;

    /**
     * StringValueObject constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value();
    }
}