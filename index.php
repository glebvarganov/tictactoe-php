<?php

require "vendor/autoload.php";
use App\TicTacToe;


echo "<h1>Нормальная игра</h1>";

$game = new TicTacToe('normal');
// Если переданы аргументы, то ходит игрок. Первый аргумент – строка, второй – столбец.
$move = $game->go(2, 2);
var_dump($move);
// Ход компьютера
$move = $game->go();
var_dump($move);
$move = $game->go(1, 2);
var_dump($move);
$move = $game->go();
var_dump($move);
// Метод go возвращает true если текущий ход победный и false в ином случае
$isWinner = $game->go(3, 2); // true
var_dump($isWinner);