<?php

declare(strict_types = 1);

namespace Bingo\Card\Domain;

use Bingo\Card\Domain\ValueObject\CardCell;
use Bingo\Card\Domain\ValueObject\Cells;
use Bingo\Shared\Domain\ValueObject\IntValueObject;

final class CardUsa implements Card
{
    private $columns;

    public static $columnDefinition = [
        ['lowerBound' => 1, 'upperBound' => 15, 'lines' => 5, 'empty' => false],
        ['lowerBound' => 16, 'upperBound' => 30, 'lines' => 5, 'empty' => false],
        ['lowerBound' => 31, 'upperBound' => 45, 'lines' => 5, 'empty' => 2],
        ['lowerBound' => 46, 'upperBound' => 60, 'lines' => 5, 'empty' => false],
        ['lowerBound' => 61, 'upperBound' => 75, 'lines' => 5, 'empty' => false]
    ];

    /**
     * CardUsa constructor.
     * @param array $columns
     */
    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }

    /**
     * @param array $columns
     * @return CardUsa
     */
    public static function create(array $columns): CardUsa
    {
        $card = new self($columns);

        return $card;
    }

    /**
     * @param IntValueObject $number
     */
    public function markNumber(IntValueObject $number)
    {
        foreach ($this->columns as $column) {
            foreach ($column as $cell) {
                if ($cell instanceof CardCell && $number->value() == $cell->value()) {
                    $cell->mark();
                }
            }
        }
    }

    /**
     * @return bool
     */
    public function isFullyMarked(): bool
    {
        foreach ($this->columns as $column) {
            foreach ($column as $cell) {
                if (!$cell->isMarked()) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @return Cells
     */
    public function getCells(): Cells
    {
        $cellsArray = array();

        foreach ($this->columns as $column) {
            foreach ($column as $cell) {
                $cellsArray[] = $cell;
            }
        }

        $cells = new Cells($cellsArray);

        return $cells;
    }

    /**
     * @return Cells
     */
    public function getMarkedCells(): Cells
    {
        $cellsArray = array();

        foreach ($this->columns as $column) {
            foreach ($column as $cell) {
                if (!$cell->isMarked()) {
                    $cellsArray[] = $cell;
                }
            }
        }

        $cells = new Cells($cellsArray);

        return $cells;
    }
}