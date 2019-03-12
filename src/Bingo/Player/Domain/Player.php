<?php

declare(strict_types=1);

namespace Bingo\Player\Domain;

use Bingo\Card\Domain\Card;

/**
 * Class Player
 * @package Bingo\Player\Domain
 */
class Player
{
    private $name;
    private $card;
    private $winner;

    public function __construct(string $name, Card $card)
    {
        $this->name = $name;
        $this->card = $card;
        $this->winner = false;
    }

    public static function create(string $name, Card $card): Player
    {
        $player = new self($name, $card);

        return $player;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCard(): Card
    {
        return $this->card;
    }

    public function isWinner(): bool
    {
        return $this->winner;
    }
}