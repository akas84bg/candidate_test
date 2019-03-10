<?php

declare(strict_types = 1);

namespace Bingo\Test\Card;

use Bingo\Card\Application\Create\CreateCardUsa;
use Bingo\Card\Domain\ValueObject\CardBlankCell;
use Bingo\Card\Domain\ValueObject\CardCell;
use Bingo\Card\Domain\CardUsa;
use Bingo\Shared\Domain\ValueObject\IntValueObject;
use PHPUnit\Framework\TestCase;

/**
 * Class CardTest
 * @package Bingo\Test\Card
 */
class CardTest extends TestCase
{
    /**
     * @var CreateCardUsa
     */
    private $creatorCardUsa;

    public function setUp(): void
    {
        $this->creatorCardUsa = new CreateCardUsa();

        parent::setUp();
    }

    /**
     * Check if the generated card is valid
     *
     * @throws \Exception
     */
    public function testValidCard()
    {
        $card = $this->creatorCardUsa->generate();

        $this->assertInstanceOf(CardUsa::class, $card);
    }

    /**
     * Test if all numbers generated are unique
     *
     * @throws \Exception
     */
    public function testNumbersAreUnique()
    {
        $card = $this->creatorCardUsa->generate();

        $cells = $card->getCells();
        $numbers = array();
        foreach ($cells as $cell) {
            if ($cell instanceof CardCell) {
                $numbers[] = $cell->value();
            }
        }

        $this->assertEquals($numbers, array_unique($numbers));
    }

    /**
     * Test if all numbers belong to a range set by card definition
     *
     * @throws \ReflectionException
     */
    public function testNumbersRangeInEachColumn()
    {
        $card = $this->creatorCardUsa->generate();
        $rules = CardUsa::$columnDefinition;

        $reflectedClass = new \ReflectionClass($card);
        $property = $reflectedClass->getProperty('columns');
        $property->setAccessible(true);
        $columns = $property->getValue($card);

        foreach ($columns as $columnKey => $column) {
            foreach ($column as $cell) {
                if ($cell instanceof CardCell) {

                    // Check if value belongs to the range in column definition
                    $this->assertGreaterThanOrEqual($rules[$columnKey]['lowerBound'], $cell->value());
                    $this->assertLessThanOrEqual($rules[$columnKey]['upperBound'], $cell->value());
                }
            }
        }
    }

    /**
     * Test if the card should have a blank number and check if it's set
     *
     * @throws \ReflectionException
     */
    public function testBlankNumberInCard()
    {
        $card = $this->creatorCardUsa->generate();
        $rules = CardUsa::$columnDefinition;

        $reflectedClass = new \ReflectionClass($card);
        $property = $reflectedClass->getProperty('columns');
        $property->setAccessible(true);
        $columns = $property->getValue($card);

        foreach ($columns as $columnKey => $column) {
            foreach ($column as $cellKey => $cell) {
                if ($rules[$columnKey]['empty'] !== false && $rules[$columnKey]['empty'] == $cellKey) {
                    $this->assertInstanceOf(CardBlankCell::class, $cell);
                }
            }
        }
    }

    /**
     * Test if a card is fully marked
     *
     * @throws \Exception
     */
    public function testIsFullyMarked()
    {
        $card = $this->creatorCardUsa->generate();

        $range = range(1,75);
        foreach ($range as $int) {
            $vo = new IntValueObject($int);

            $card->markNumber($vo);
        }

        $this->assertTrue($card->isFullyMarked());
    }
}