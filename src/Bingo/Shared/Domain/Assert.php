<?php

declare(strict_types = 1);

namespace Bingo\Shared\Domain;

use InvalidArgumentException;

/**
 * Class Assert
 * @package Bingo\Shared\Domain
 */
final class Assert
{
    /**
     * @param string $class
     * @param array $items
     */
    public static function arrayOf(string $class, array $items)
    {
        foreach ($items as $item) {
            self::instanceOf($class, $item);
        }
    }

    /**
     * @param $class
     * @param $item
     */
    public static function instanceOf($class, $item)
    {
        if (!$item instanceof $class) {
            throw new InvalidArgumentException(
                sprintf('The object <%s> is not an instance of <%s>', $class, get_class($item))
            );
        }
    }
}
