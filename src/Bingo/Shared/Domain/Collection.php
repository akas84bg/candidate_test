<?php

declare(strict_types = 1);

namespace Bingo\Shared\Domain;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use function Lambdish\Phunctional\each;

/**
 * Class Collection
 * @package Bingo\Shared\Domain
 */
abstract class Collection extends \ArrayObject
{
    /** @var array */
    private $items;

    /**
     * Collection constructor.
     * @param array $items
     */
    public function __construct(array $items)
    {
        Assert::arrayOf($this->type(), $items);

        $this->items = $items;
    }

    /**
     * @return string
     */
    abstract protected function type(): string;

    /**
     * @return ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items());
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items());
    }

    /**
     * @param callable $fn
     */
    protected function each(callable $fn)
    {
        each($fn, $this->items());
    }

    /**
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->items);
    }

    /**
     * @return bool
     */
    public function shuffle(): bool
    {
        return shuffle($this->items);
    }

    /**
     * @return array
     */
    protected function items()
    {
        return $this->items;
    }
}
