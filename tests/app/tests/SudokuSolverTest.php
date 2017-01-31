<?php

namespace app\tests;


use app\SudokuSolver;


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
     * @param array $puzzle
     * @param array
     * @dataProvider complexPuzzleDataProvider
     */
    public function testComplexPuzzle($puzzle, $expectedSolution)
    {
        $sudokuSolver = new SudokuSolver($puzzle);

        $success = $sudokuSolver->solve();
        $solution = $sudokuSolver->getSolution();

        $this->assertTrue($success);
        $this->assertEquals($expectedSolution, $solution);
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
     * Data provider for the testComplexPuzzle method.
     *
     * @return array
     */
    public function complexPuzzleDataProvider()
    {
        return [
            [$this->getComplexPuzzle1(), $this->getComplexPuzzle1Solution()],
            [$this->getComplexPuzzle2(), $this->getComplexPuzzle2Solution()],
        ];
    }

    /**
     * Returns a complex sudoku puzzle.
     * @return array
     */
    private function getComplexPuzzle1()
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
    private function getComplexPuzzle1Solution()
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
     * Return the second complex puzzle to be tested.
     * @return array
     */
    private function getComplexPuzzle2()
    {
        return [
            [5,3,0,0,7,0,0,0,0],
            [6,0,0,1,9,5,0,0,0],
            [0,9,8,0,0,0,0,6,0],
            [8,0,0,0,6,0,0,0,3],
            [4,0,0,8,0,3,0,0,1],
            [7,0,0,0,2,0,0,0,6],
            [0,6,0,0,0,0,2,8,0],
            [0,0,0,4,1,9,0,0,5],
            [0,0,0,0,8,0,0,7,9],
        ];
    }

    /**
     * Returns the solution for the second complex puzzle.
     * @return array
     */
    private function getComplexPuzzle2Solution()
    {
        return [
            [5,3,4,6,7,8,9,1,2],
            [6,7,2,1,9,5,3,4,8],
            [1,9,8,3,4,2,5,6,7],
            [8,5,9,7,6,1,4,2,3],
            [4,2,6,8,5,3,7,9,1],
            [7,1,3,9,2,4,8,5,6],
            [9,6,1,5,3,7,2,8,4],
            [2,8,7,4,1,9,6,3,5],
            [3,4,5,2,8,6,1,7,9],
        ];
    }
}
