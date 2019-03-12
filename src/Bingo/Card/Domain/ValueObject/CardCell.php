<?php

declare(strict_types=1);

namespace Bingo\Card\Domain\ValueObject;

use Bingo\Shared\Domain\ValueObject\IntValueObject;

/**
 * Class CardCell
 * @package Bingo\Domain\ValueObject
 */
final class CardCell extends IntValueObject implements Cell
{
    private $marked;

    /**
     * CardCell constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        parent::__construct($value);

        $this->marked = false;
    }

    /**
     * Static method to create a cell
     *
     * @param int $value
     * @return CardCell
     */
    public static function create(int $value): CardCell
    {
        $cell = new self($value);

        return $cell;
    }

    /**
     * Check if this cell is marked
     *
     * @return bool
     */
    public function isMarked(): bool
    {
        return $this->marked;
    }

    /**
     * Mark this cell as a flag
     */
    public function mark(): void
    {
        $this->marked = true;
    }

    /**
     * Return the cell value
     *
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
}