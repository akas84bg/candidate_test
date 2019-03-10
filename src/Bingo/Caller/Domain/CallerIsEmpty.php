<?php

declare(strict_types = 1);

namespace Bingo\Caller\Domain;

use Bingo\Shared\Domain\DomainError;

/**
 * Class CallerIsEmpty
 * @package Bingo\Caller\Domain
 */
final class CallerIsEmpty extends DomainError
{
    /**
     * @return string
     */
    public function errorCode(): string
    {
        return 'caller_is_empty';
    }

    /**
     * @return string
     */
    protected function errorMessage(): string
    {
        return 'Caller has no more numbers available';
    }
}