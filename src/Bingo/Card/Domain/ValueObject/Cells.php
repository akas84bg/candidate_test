<?php

declare(strict_types = 1);

namespace Bingo\Card\Domain\ValueObject;

use Bingo\Shared\Domain\Collection;

/**
 * Class Cells
 * @package Bingo\Card\Domain\ValueObject
 */
final class Cells extends Collection
{
    protected function type(): string
    {
        return Cell::class;
    }
}
