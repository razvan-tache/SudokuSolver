<?php

namespace app\tests;


use app\SudokuChecker;


class SudokuCheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the functionality of the isSolved method.
     *
     * @param array   $puzzle
     * @param boolean $expected
     * @dataProvider isSolvedData
     */
    public function testIsSolved($puzzle, $expected)
    {
        $this->assertEquals($expected, SudokuChecker::getInstance()->isSolved($puzzle));
    }

    /**
     * Data provider for @testIsSolved
     * @return array
     */
    public function isSolvedData()
    {
        return [
            [$this->getCorrectPuzzle(), true],
            [$this->getIncorectPuzzle(), false],
            [$this->getIncompletePuzzle(), false],
        ];
    }

    /**
     * Returns a completed sudoku.
     * @return array
     */
    private function getCorrectPuzzle()
    {
        return [
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
    }

    /**
     * Return an incomplete sudoku puzzle.
     * @return array
     */
    private function getIncorectPuzzle()
    {
        return [
            [1, 2, 3, 4, 5, 6, 7, 8, 9,],
            [4, 5, 6, 7, 8, 9, 1, 2, 3,],
            [7, 8, 9, 1, 2, 3, 4, 5, 6,],
            [2, 3, 1, 3, 6, 4, 8, 9, 7,],
            [5, 6, 4, 8, 9, 7, 2, 3, 1,],
            [8, 9, 7, 2, 3, 1, 8, 6, 4,],
            [3, 1, 2, 9, 4, 5, 9, 7, 8,],
            [6, 4, 5, 9, 7, 8, 3, 1, 2,],
            [9, 7, 8, 3, 1, 2, 6, 4, 5,],
        ];
    }

    /**
     * Return an incomplete sudoku puzzle.
     * @return array
     */
    private function getIncompletePuzzle()
    {
        return [
            [1, 2, 3, 4, 5, 6, 7, 8, 9,],
            [4, 0, 6, 7, 0, 9, 1, 2, 3,],
            [7, 8, 9, 1, 2, 3, 4, 5, 6,],
            [2, 3, 1, 5, 6, 4, 8, 9, 7,],
            [5, 6, 4, 8, 9, 7, 2, 3, 1,],
            [8, 9, 7, 2, 0, 1, 5, 6, 4,],
            [3, 1, 2, 6, 4, 5, 9, 7, 8,],
            [6, 4, 5, 9, 7, 8, 3, 1, 2,],
            [9, 7, 8, 3, 1, 2, 6, 4, 5,],
        ];
    }
}
