<?php

namespace App\strategies;

class Random
{
    public function nextStep($gameArea, $symbol, $defaultSymbol)
    {
        for ($i = 0; $i < INF; $i++) {
            $row = rand(1, 3);
            $col = rand(1, 3);
            if ($gameArea[$row][$col] == $defaultSymbol) {
                $gameArea[$row][$col] = $symbol;
                break;
            }
        }
        return $gameArea;
    }
}