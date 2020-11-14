<?php

namespace App\strategies;

class Easy
{
    public function nextStep($gameArea, $symbol, $defaultSymbol)
    {
        for ($row = 1; $row < 4; $row++) {
            for ($column = 1; $column < 4; $column++) {
                if ($gameArea[$row][$column] == $defaultSymbol) {
                    $gameArea[$row][$column] = $symbol;
                    break 2;
                }
            }
        }
        return $gameArea;
    }
}
