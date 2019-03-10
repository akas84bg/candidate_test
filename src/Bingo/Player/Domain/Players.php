<?php

declare(strict_types = 1);

namespace Bingo\Player\Domain;

use Bingo\Shared\Domain\Collection;

/**
 * Class Players
 * @package Bingo\Player\Domain
 */
class Players extends Collection
{
    protected function type(): string
    {
        return Player::class;
    }
}
