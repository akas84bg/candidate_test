<?php

declare(strict_types = 1);

namespace Bingo\Caller\Domain;

use Bingo\Shared\Domain\ValueObject\IntValueObject;

/**
 * Class Caller
 * @package Bingo\Domain
 */
class Caller
{
    private $stack;

    /**
     * Caller constructor.
     * @param CallerNumbers $stack
     */
    public function __construct(CallerNumbers $stack)
    {
        $this->stack = $stack;
        $this->stack->shuffle();
    }

    /**
     * @param CallerNumbers $stack
     * @return Caller
     */
    public static function create(CallerNumbers $stack)
    {
        $caller = new self($stack);

        return $caller;
    }

    /**
     * Method which will be called to draw numbers from the stack
     */
    public function draw(): IntValueObject
    {
        $number = $this->stack->pop();

        if (is_null($number)) {
            throw new CallerIsEmpty();
        }

        return $number;
    }
}