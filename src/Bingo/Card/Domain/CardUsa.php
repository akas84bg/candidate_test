<?php

declare(strict_types = 1);

namespace Bingo\Card\Domain;

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
     * @param $number
     */
    public function markNumber($number)
    {

    }

    /**
     * @return bool
     */
    public function isFullyMarked(): bool
    {
        return true;
    }
}