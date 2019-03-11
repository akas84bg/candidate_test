<?php

declare(strict_types = 1);

namespace Bingo\Test\Card;

use Bingo\Caller\Domain\Caller;
use Bingo\Card\Domain\Card;
use Bingo\Game\Domain\Game;
use Bingo\Player\Domain\Player;
use Bingo\Player\Domain\Players;
use Bingo\Shared\Domain\ValueObject\IntValueObject;
use PHPUnit\Framework\TestCase;

/**
 * Class GameTest
 * @package Bingo\Test\Card
 */
class GameTest extends TestCase
{
    /**
     * We will check if a player is a winner
     *
     * @throws \Exception
     */
    public function testPlayerIsWinner()
    {
        $card = $this->createMock(Card::class);
        $caller = $this->createMock(Caller::class);
        $intValueObject = $this->createMock(IntValueObject::class);
        $player = $this->createMock(Player::class);
        $players = new Players(array($player));


        $caller->expects($this->atLeastOnce())
            ->method('draw')
            ->will($this->returnValue($intValueObject));

        $player->expects($this->atLeastOnce())
            ->method('getCard')
            ->will($this->returnValue($card));

        $card->expects($this->atLeastOnce())
            ->method('isFullyMarked')
            ->will($this->returnValue(true));

        $card->expects($this->atLeastOnce())
            ->method('markNumber');


        $game = Game::create($caller, $players);
        $game->play()->next();

        $this->assertSame($player, $game->getWinner());
    }

    /**
     * We will check if a player is not a winner
     *
     * @throws \ReflectionException
     */
    public function testPlayerIsLoser()
    {
        $card = $this->createMock(Card::class);
        $caller = $this->createMock(Caller::class);
        $intValueObject = $this->createMock(IntValueObject::class);
        $player = $this->createMock(Player::class);
        $players = new Players(array($player));


        $caller->expects($this->atLeastOnce())
            ->method('draw')
            ->will($this->returnValue($intValueObject));

        $player->expects($this->atLeastOnce())
            ->method('getCard')
            ->will($this->returnValue($card));

        $card->expects($this->atLeastOnce())
            ->method('isFullyMarked')
            ->will($this->returnValue(false));

        $card->expects($this->atLeastOnce())
            ->method('markNumber');


        $game = Game::create($caller, $players);
        $game->play()->next();

        $this->assertEmpty($game->getWinner());
    }
}