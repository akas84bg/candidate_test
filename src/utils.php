<?php

declare(strict_types = 1);

namespace Utils;

/**
 * @param int $min
 * @param int $max
 * @param array $excludedNumbers
 * @return int
 * @throws \Exception
 */
function randomUniqueNumber(int $min, int $max, array $excludedNumbers = array()): int
{
    do {
        $number = random_int($min, $max);
    } while (in_array($number, $excludedNumbers));

    return $number;
}