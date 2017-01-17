<?php

require_once './src/SudokuChecker.php';

$puzzle = [
    [1, 2, 3, 4, 5, 6, 7, 8, 9,],
    [4, 5, 6, 7, 8, 9, 1, 2, 3,],
    [7, 8, 9, 1, 2, 3, 4, 5, 6,],
    [2, 3, 1, 5, 6, 4, 8, 9, 7,],
    [5, 6, 4, 8, 9, 7, 2, 3, 1,],
    [8, 9, 7, 2, 3, 1, 5, 6, 4,],
    [3, 1, 2, 6, 4, 5, 9, 7, 8,],
    [6, 4, 5, 9, 7, 8, 3, 1, 2,],
    [9, 7, 8, 3, 1, 2, 6, 4, 5,],
];

if (SudokuChecker::getInstance()->isSolved($puzzle)) {
    echo "Puzzle is valid\n";
}