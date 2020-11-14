<?php

namespace App;

use App\strategies as strategy;

class TicTacToe
{
    private $level;
    private $gameArea;
    private $move = 1;
    private $empty = '*';
    private $even = 'o';
    private $odd = 'x';

    // BEGIN (write your solution here)
    public function __construct($level = 'easy')
    {

        // Определим стратегию
        $mapping = [
            'easy' => new strategy\Easy(),
            'normal' => new strategy\Normal(),
            'random' => new strategy\Random(),
        ];

        // Установим метод
        $this->level = isset($mapping[$level]) ? $mapping[$level] : $mapping['random'];

        // Дефолтное поле
        $this->gameArea = array_fill(1, 3, array_fill(1, 3, $this->empty));
    }

    public function go($row = null, $column = null)
    {
        $symbol = ($this->move % 2 == 0) ? $this->even : $this->odd;
        $gameArea = $this->getGameArea();

        if ($row && $column) {
            $gameArea[$row][$column] = $symbol;
        } else {
            $gameArea = $this->level->nextStep($gameArea, $symbol, $this->empty);
        }

        $this->gameArea = $gameArea;
        $this->move += 1;

        echo '<pre>';
        echo $this->drawGameArea($gameArea);
        echo '</pre>';

        return $this->checkEndGame();
    }

    public function getGameArea()
    {
        return $this->gameArea;
    }

    public function drawGameArea($gameArea)
    {
        $image = '<table border="1">';
        for ($row = 1; $row < 4; $row++) {
            $image .= '<tr>';
            for ($column = 1; $column < 4; $column++) {
                $image .= "<td>" . $gameArea[$row][$column] . "</td>";
            }
            $image .= '</tr>';
        }
        $image .= '</table>';

        return $image;
    }

    public function checkEndGame()
    {
        $ga = $this->getGameArea();

        if (($ga[1][1] != $this->empty && $ga[1][1] == $ga[1][2] && $ga[1][1] == $ga[1][3]) ||
            ($ga[2][1] != $this->empty && $ga[2][1] == $ga[2][2] && $ga[2][1] == $ga[2][3]) ||
            ($ga[3][1] != $this->empty && $ga[3][1] == $ga[3][2] && $ga[3][1] == $ga[3][3]) ||
            ($ga[1][1] != $this->empty && $ga[1][1] == $ga[2][1] && $ga[1][1] == $ga[3][1]) ||
            ($ga[1][2] != $this->empty && $ga[1][2] == $ga[2][2] && $ga[1][2] == $ga[3][2]) ||
            ($ga[1][3] != $this->empty && $ga[1][3] == $ga[2][3] && $ga[1][3] == $ga[3][3]) ||
            ($ga[1][1] != $this->empty && $ga[1][1] == $ga[2][2] && $ga[1][1] == $ga[3][3]) ||
            ($ga[1][3] != $this->empty && $ga[1][3] == $ga[2][2] && $ga[1][3] == $ga[3][1])
        ) {
            return true;
        }
        return false;
    }
    // END
}
