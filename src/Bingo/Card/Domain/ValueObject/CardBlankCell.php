<?php

declare(strict_types = 1);

namespace Bingo\Card\Domain\ValueObject;

/**
 * Class CardBlankCell
 * @package Bingo\Domain\ValueObject
 */
final class CardBlankCell implements Cell
{
    private $marked;

    /**
     * CardBlankCell constructor.
     * @param int $value
     */
    public function __construct()
    {
        $this->marked = true;
    }

    /**
     * Static method to create a blank cell
     *
     * @return CardBlankCell
     */
    public static function create(): CardBlankCell
    {
        $cell = new self();

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
}