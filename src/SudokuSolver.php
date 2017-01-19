<?php

namespace app;
/**
 * Created by PhpStorm.
 * User: razvan
 * Date: 16/01/2017
 * Time: 23:37
 *
 * TODO: Remove the columns, rows, squares approach
 * TODO: Make suggestion local and add a new method for fetching it as a array of suggestions not an array of arrays of arrays
 */
class SudokuSolver
{
    private $puzzle;
    private $solution = [];
    private $rows = [];
    private $columns = [];
    private $squares = [];
    private $suggestions;

    /**
     * SudokuSolver constructor.
     * TODO: Test this functionality.
     * @param array $puzzle
     */
    public function __construct(array $puzzle)
    {
        $this->suggestions = [];
        $this->puzzle = $puzzle;
        for ($i = 0; $i < 9; $i++) {
            $this->suggestions[$i] = [];
            for ($j = 0; $j < 9; $j++) {
                $this->rows[$i][] = $puzzle[$i][$j];
                $this->columns[$j][] = $puzzle[$i][$j];
                $squareRow = intval($j / 3) + intval($i / 3) * 3;
                $squareColumn = $j % 3 + ($i % 3) * 3;;
                $this->squares[$squareRow][$squareColumn] = $puzzle[$i][$j];

                $this->suggestions[$i][$j] = [];
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

            for ($i = 0; $i < 9; $i++) {
                for ($j = 0; $j < 9; $j++) {
                    if ($this->solution[$i][$j] == 0) {
                        $this->suggestions[$i][$j] = $this->getPossibleOptions($i, $j);
                        if (count($this->suggestions[$i][$j]) === 1) {
                            $this->solution[$i][$j] = $this->suggestions[$i][$j][0];

                            $i = -1;
                            break;
                        }
                    }
                }
            }

            if (SudokuChecker::getInstance()->isSolved($this->solution)) {
                return true;
            } else {

            }
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

    private function getPossibleOptions($row, $col)
    {
        $suggestion = [];
        if ($this->solution[$row][$col] == 0) {
            $suggestion = array_slice($this->solution[$row], 0, 9);
            $squareRow = intval($row / 3) * 3;
            $squareCol = intval($col / 3) * 3;
            $suggestion = array_merge(
                $suggestion,
                array_slice($this->solution[$squareRow], $squareCol, 3),
                array_slice($this->solution[$squareRow + 1], $squareCol, 3),
                array_slice($this->solution[$squareRow + 2], $squareCol, 3)
            );

            $comparable = [];
            for ($i = 0; $i < 9; $i++) {
                if (!in_array($this->solution[$i][$col], $suggestion)) {
                    $suggestion[] = $this->solution[$i][$col];
                }
                $comparable[] = $i + 1;
            }

            $suggestion = array_diff($comparable, $suggestion);
        }

        return array_values($suggestion);
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

/**
 * Solve complex:
 * req function solveComplex(solution, suggestions, history):
 *  // take the first suggestion and add it to solution
 *      // if no test validity and success
 *      // return false or the solution
 *  // add the change to history
 *  // rebuild suggestions
 *  // success = solveComplex(solution, suggestion, history);
 *  if (is_array(success)) {
 *      return solution;
 *  } else {
 *      // undo what you did
 *      // remove yourself from suggestions
 *          // recall yourself for that element, if no element remains then you should return false
 *  }
 */