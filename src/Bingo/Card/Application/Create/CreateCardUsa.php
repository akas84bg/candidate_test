<?php

declare(strict_types=1);

namespace Bingo\Card\Application\Create;

use Bingo\Card\Domain\ValueObject\CardBlankCell;
use Bingo\Card\Domain\ValueObject\CardCell;
use Bingo\Card\Domain\CardUsa;
use function Utils\randomUniqueNumber;

/**
 * Class CreateCardUsa
 * @package Bingo\Application\Create
 */
final class CreateCardUsa
{
    /**
     * @throws \Exception
     */
    public function generate()
    {
        $rules = CardUsa::$columnDefinition;
        $columns = array();
        $generatedNumbers = array();

        foreach ($rules as $column => $rule) {
            for ($line = 0; $line < $rule['lines']; ++$line) {
                if ($rule['empty'] !== false && $line == $rule['empty']) {
                    $columns[$column][$line] = CardBlankCell::create();

                    continue;
                }

                $generatedNumber = randomUniqueNumber($rule['lowerBound'], $rule['upperBound'], $generatedNumbers);

                $generatedNumbers[] = $generatedNumber;
                $columns[$column][$line] = CardCell::create($generatedNumber);
            }
        }

        $card = CardUsa::create($columns);

        return $card;
    }
}