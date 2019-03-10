<?php

declare(strict_types = 1);

namespace Bingo\Card\Domain\ValueObject;

/**
 * Interface Cell
 * @package Bingo\Card\Domain\ValueObject
 */
interface Cell
{
    public function isMarked();
}