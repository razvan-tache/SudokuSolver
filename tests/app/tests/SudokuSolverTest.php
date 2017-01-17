<?php

namespace app\tests;


use SudokuSolver;


class SudokuSolverTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests an invalid puzzle. A puzzle which cannot be simple solved.
     */
    public function testSimpleInvalidPuzzle()
    {
        $sudokuSolver = new SudokuSolver($this->getInvalidPuzzle());

        $success = $sudokuSolver->solve();
        $solution = $sudokuSolver->getSolution();

        $this->assertFalse($success);
        $this->assertNull($solution);
    }

    /**
     * Tests a simple puzzle.
     * A simple puzzle is a sudoku which has for each empty cell only one possible solution.
     */
    public function testSimplePuzzle()
    {
        $sudokuSolver = new SudokuSolver($this->getSimplePuzzle());

        $success = $sudokuSolver->solve();
        $solution = $sudokuSolver->getSolution();

        $this->assertTrue($success);
        $this->assertEquals($this->getSimplePuzzleSolution(), $solution);
    }

    /**
     * Tests a complex puzzle.
     * A complex puzzle is a sudoku which can have more than one option per empty cell.
     */
    public function testComplexPuzzle()
    {
        $sudokuSolver = new SudokuSolver($this->getComplexPuzzle());

        $success = $sudokuSolver->solve();
        $solution = $sudokuSolver->getSolution();

        $this->assertTrue($success);
        $this->assertEquals($this->getComplexPuzzleSolution(), $solution);
    }

    /**
     * Returns an invalid puzzle.
     * @return array
     */
    private function getInvalidPuzzle()
    {
        return [
            [1, 2, 3, 4, 5, 6, 7, 8, 9,],
            [4, 5, 6, 7, 8, 9, 1, 2, 3,],
            [7, 9, 9, 1, 0, 3, 4, 0, 6,],
            [2, 3, 1, 5, 6, 4, 8, 9, 7,],
            [5, 6, 4, 8, 9, 7, 2, 3, 1,],
            [8, 9, 7, 2, 3, 1, 5, 6, 4,],
            [3, 0, 2, 6, 4, 5, 9, 7, 8,],
            [6, 4, 5, 9, 7, 0, 3, 1, 2,],
            [9, 7, 8, 3, 1, 2, 6, 4, 5,],
        ];
    }

    /**
     * Returns a simple puzzle.
     * @return array
     */
    private function getSimplePuzzle()
    {
        return [
            [1, 2, 3, 4, 5, 6, 7, 8, 9,],
            [4, 5, 0, 7, 8, 9, 1, 2, 3,],
            [7, 8, 9, 1, 2, 3, 4, 5, 6,],
            [2, 3, 1, 5, 0, 4, 8, 9, 7,],
            [5, 6, 4, 8, 9, 7, 2, 3, 1,],
            [8, 9, 7, 2, 3, 1, 5, 6, 4,],
            [3, 0, 2, 6, 4, 5, 9, 7, 8,],
            [6, 4, 5, 9, 7, 8, 3, 0, 2,],
            [9, 7, 8, 3, 1, 0, 6, 4, 5,],
        ];
    }

    /**
     * Returns the simple puzzle solution.
     * @return array
     */
    private function getSimplePuzzleSolution()
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
     * Returns a complex sudoku puzzle.
     * @return array
     */
    private function getComplexPuzzle()
    {
        return [
            [0, 2, 3, 4, 0, 0, 0, 0, 9,],
            [4, 0, 0, 7, 0, 9, 1, 2, 0,],
            [0, 0, 9, 1, 2, 3, 0, 5, 6,],
            [2, 3, 1, 5, 0, 4, 8, 0, 7,],
            [5, 0, 4, 8, 9, 7, 2, 3, 0,],
            [0, 9, 7, 2, 3, 1, 5, 0, 4,],
            [3, 0, 2, 6, 4, 0, 0, 7, 0,],
            [6, 4, 5, 9, 0, 8, 3, 0, 2,],
            [9, 7, 8, 0, 1, 0, 6, 4, 5,],
        ];
    }

    /**
     * Returns the solution for the complex puzzle.
     * @return array
     */
    private function getComplexPuzzleSolution()
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
}
