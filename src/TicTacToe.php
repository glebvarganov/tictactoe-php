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
        ];

        $this->level = $mapping[$level];

        /*
        if ($level == 'easy') {
            $this->level = new strategy\Easy();
        } else {
            $this->level = new strategy\Normal();
        }
        */

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
        $gameArea = $this->getGameArea();

        if ($gameArea[1][1] != $this->empty &&
            $gameArea[1][1] == $gameArea[1][2] && $gameArea[1][1] == $gameArea[1][3]) {
            return true;
        }

        if ($gameArea[2][1] != $this->empty &&
            $gameArea[2][1] == $gameArea[2][2] && $gameArea[2][1] == $gameArea[2][3]) {
            return true;
        }

        if ($gameArea[3][1] != $this->empty &&
            $gameArea[3][1] == $gameArea[3][2] && $gameArea[3][1] == $gameArea[3][3]) {
            return true;
        }

        if ($gameArea[1][1] != $this->empty &&
            $gameArea[1][1] == $gameArea[2][1] && $gameArea[1][1] == $gameArea[3][1]) {
            return true;
        }

        if ($gameArea[1][2] != $this->empty &&
            $gameArea[1][2] == $gameArea[2][2] && $gameArea[1][2] == $gameArea[3][2]) {
            return true;
        }

        if ($gameArea[1][3] != $this->empty &&
            $gameArea[1][3] == $gameArea[2][3] && $gameArea[1][3] == $gameArea[3][3]) {
            return true;
        }

        if ($gameArea[1][1] != $this->empty &&
            $gameArea[1][1] == $gameArea[2][2] && $gameArea[1][1] == $gameArea[3][3]) {
            return true;
        }

        if ($gameArea[1][3] != $this->empty &&
            $gameArea[1][3] == $gameArea[2][2] && $gameArea[1][3] == $gameArea[3][1]) {
            return true;
        }
        return false;
    }
    // END
}
