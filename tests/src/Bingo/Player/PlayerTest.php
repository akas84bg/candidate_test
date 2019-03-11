<?php

declare(strict_types = 1);

namespace Bingo\Test\Card;

use Bingo\Card\Domain\Card;
use Bingo\Player\Domain\Player;
use PHPUnit\Framework\TestCase;

/**
 * Class PlayerTest
 * @package Bingo\Test\Card
 */
class PlayerTest extends TestCase
{
    /**
     * Check if return a card
     *
     * @throws \Exception
     */
    public function testPlayerCard()
    {
        $card = $this->createMock(Card::class);
        $player = Player::create($this->generateRandomString(), $card);

        $this->assertSame($card, $player->getCard());
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateRandomString(int $length = 10): string {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}