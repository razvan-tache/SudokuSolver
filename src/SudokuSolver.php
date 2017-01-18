<?php

namespace app;
/**
 * Created by PhpStorm.
 * User: razvan
 * Date: 16/01/2017
 * Time: 23:37
 */
class SudokuSolver
{
    private $puzzle;
    private $solution = [];
    private $rows = [];
    private $columns = [];
    private $squares = [];

    /**
     * SudokuSolver constructor.
     * TODO: Test this functionality.
     * @param array $puzzle
     */
    public function __construct(array $puzzle)
    {
        $this->puzzle = $puzzle;
        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 9; $j++) {
                $this->rows[$i][] = $puzzle[$i][$j];
                $this->columns[$j][] = $puzzle[$i][$j];
                $squareRow = intval($j / 3) + intval($i / 3) * 3;;
                $squareColumn = $j % 3 + ($i % 3) * 3;;
                $this->squares[$squareRow][$squareColumn] = $puzzle[$i][$j];
            }
        }
    }

    /**
     * @return bool
     */
    public function solve()
    {
        $this->solution = $this->puzzle;
        if ($this->isValidSolution()) {

        } else {
            $this->solution = null;

            return false;
        }
        return false;
    }

    /**
     * @return array
     */
    public function getSolution()
    {
        return $this->solution;
    }

    /**
     * Checks if the puzzle is valid.
     * TODO: Create a simple data structure that behaves like a set.
     * Maybe this should be inside SudokuChecker?
     * @return bool
     */
    private function isValidSolution()
    {
        for ($i = 0; $i < 9; $i++) {
            $inRow = [];
            $inCol = [];
            $inSquare = [];
            for ($j = 0; $j < 9; $j++) {
                if (in_array($this->rows[$i][$j], $inRow)) {
                    return false;
                } else {
                    $inRow[] = $this->rows[$i][$j];
                }

                if (in_array($this->columns[$i][$j], $inCol)) {
                    return false;
                } else {
                    $inCol[] = $this->columns[$i][$j];
                }

                if (in_array($this->squares[$i][$j], $inSquare)) {
                    return false;
                } else {
                    $inSquare[] = $this->squares[$i][$j];
                }
            }
        }
        return true;
    }
}