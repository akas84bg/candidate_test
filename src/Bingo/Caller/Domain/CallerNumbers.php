<?php

declare(strict_types=1);

namespace Bingo\Caller\Domain;

use Bingo\Shared\Domain\Collection;
use Bingo\Shared\Domain\ValueObject\IntValueObject;

/**
 * Class CallerNumbers
 * @package Bingo\Caller\Domain
 */
final class CallerNumbers extends Collection
{
    protected function type(): string
    {
        return IntValueObject::class;
    }
}
