<?php

declare(strict_types=1);

namespace Bingo\Shared\Domain;

use DomainException;

/**
 * Class DomainError
 * @package Bingo\Shared\Domain
 */
abstract class DomainError extends DomainException
{
    /**
     * DomainError constructor.
     */
    public function __construct()
    {
        parent::__construct($this->errorMessage());
    }

    /**
     * @return string
     */
    abstract public function errorCode(): string;

    /**
     * @return string
     */
    abstract protected function errorMessage(): string;
}
