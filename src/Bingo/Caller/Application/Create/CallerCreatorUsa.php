<?php

declare(strict_types = 1);

namespace Bingo\Caller\Application\Create;

use Bingo\Caller\Domain\CallerNumbers;
use Bingo\Caller\Domain\Caller;
use Bingo\Shared\Domain\ValueObject\IntValueObject;
use function Lambdish\Phunctional\map;

/**
 * Class CallerCreatorUsa
 * @package Bingo\Caller\Application\Create
 */
final class CallerCreatorUsa implements CallerCreator
{
    /**
     * @return Caller
     */
    public static function create(): Caller
    {
        $numberClassGenerator = function (int $number): IntValueObject {
            return new IntValueObject($number);
        };

        $callerNumbers = new CallerNumbers(map($numberClassGenerator, range(1,75)));
        $caller = new Caller($callerNumbers);

        return $caller;
    }
}