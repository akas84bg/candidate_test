<?php

declare(strict_types = 1);

namespace Bingo\Test\Caller;

use Bingo\Caller\Application\Create\CallerCreatorUsa;
use Bingo\Caller\Domain\CallerIsEmpty;
use Bingo\Shared\Domain\ValueObject\IntValueObject;
use PHPUnit\Framework\TestCase;

/**
 * Class CallerTest
 * @package Bingo\Test\Caller
 */
class CallerTest extends TestCase
{
    /**
     * We will call more numbers than we have available so we are expecting an exception
     *
     * @throws \Exception
     */
    public function testCallerException()
    {
        $this->expectException(CallerIsEmpty::class);

        $caller = CallerCreatorUsa::create();

        for ($i = 0; $i <= 75; ++$i) {
            $caller->draw();
        }
    }

    /**
     * We will expect an IntValueObject when we call draw method
     */
    public function testCallerDrawReturnedValue()
    {
        $caller = CallerCreatorUsa::create();

        $number = $caller->draw();

        $this->assertInstanceOf(IntValueObject::class, $number);
    }

    /**
     * If we call 75 numbers, we should have 75 unique numbers
     */
    public function testCallerRepetition()
    {
        $caller = CallerCreatorUsa::create();

        $numbers = array();

        for ($i = 0; $i < 75; ++$i) {
            $numbers[] = $caller->draw()->value();
        }

        $this->assertEquals($numbers, array_unique($numbers));
    }

    /**
     * If we call 75 numbers, all numbers should be between the 1-75 range
     */
    public function testCallerRange()
    {
        $caller = CallerCreatorUsa::create();

        for ($i = 0; $i < 75; ++$i) {
            $number = $caller->draw()->value();

            $this->assertLessThanOrEqual(75, $number);
            $this->assertGreaterThanOrEqual(1, $number);
        }
    }
}