<?php

declare(strict_types=1);

namespace Bingo\Card\Domain;

use Bingo\Card\Domain\ValueObject\Cells;
use Bingo\Shared\Domain\ValueObject\IntValueObject;

/**
 * Interface Card
 * @package Bingo\Card\Domain
 */
interface Card
{
    public function isFullyMarked(): bool;

    public function markNumber(IntValueObject $number);

    public function getCells(): Cells;

    public function getMarkedCells(): Cells;
}