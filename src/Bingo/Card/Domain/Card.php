<?php

declare(strict_types = 1);

namespace Bingo\Card\Domain;

/**
 * Interface Card
 * @package Bingo\Card\Domain
 */
interface Card
{
    public function isFullyMarked(): bool;
    public function markNumber($number);
}