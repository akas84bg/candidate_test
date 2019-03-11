<?php

namespace Bingo\Game\Domain;

use Bingo\Caller\Domain\CallerIsEmpty;
use Bingo\Caller\Domain\Caller;
use Bingo\Player\Domain\Player;
use Bingo\Player\Domain\Players;
use Bingo\Shared\Domain\ValueObject\IntValueObject;

final class Game implements GameInterface
{
    private $caller;
    private $players;
    private $winner;

    /**
     * Game constructor.
     * @param Caller $caller
     * @param Players $players
     */
    public function __construct(Caller $caller, Players $players)
    {
        $this->caller = $caller;
        $this->players = $players;
    }

    /**
     * @param Caller $caller
     * @param Players $players
     * @return Game
     */
    public static function create(Caller $caller, Players $players): Game
    {
        $game = new self($caller, $players);

        return $game;
    }

    public function play()
    {
        while (!$this->getWinner()) {
            try {
                $number = $this->caller->draw();

                $this->sendNumberToPlayers($number);

                yield $number;

            } catch (CallerIsEmpty $ex) {
                break;
            }
        }
    }

    /**
     * @return Player|Null
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @param IntValueObject $number
     */
    private function sendNumberToPlayers(IntValueObject $number): void
    {
        foreach ($this->players as $player) {
            $player->getCard()->markNumber($number);
            if ($player->getCard()->isFullyMarked()) {
                $this->winner = $player;
            }
        }
    }
}