<?php

/**
 * TODO: Test this class
 * A singleton which can check if a sudoku puzzle is solved.
 *
 */
class SudokuChecker
{
    /**
     * @var SudokuChecker
     */
    private static $instance = null;

    /**
     * SudokuSolver constructor.
     */
    private function __construct()
    {
    }

    /**
     * Returns if the sudoku puzzle is solved.
     *
     * @param array $puzzle
     * @return boolean;
     */
    public function isSolved($puzzle)
    {
        for ($i = 0; $i < 9; $i++) {
            if (!$this->checkRow($puzzle, $i) || !$this->checkColumn($puzzle, $i) || !$this->checkSquare($puzzle, $i)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return SudokuChecker
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new SudokuChecker();
        }

        return self::$instance;
    }
    /**
     * Checks if a given row is valid.
     * @param array $puzzle
     * @param int   $row
     * @return boolean
     */
    private function checkRow($puzzle, $row)
    {
        $checksum = $this->getCheckSum();
        $totalRows = 0;
        for ($col = 0; $col < 9; $col++) {
            $totalRows += pow($puzzle[$row][$col], 2);
        }

        return $totalRows === $checksum;
    }

    /**
     * Checks if a given column is valid.
     *
     * @param array $puzzle
     * @param int   $col
     * @return bool
     */
    private function checkColumn($puzzle, $col)
    {
        $checksum = $this->getCheckSum();
        $totalCols = 0;
        for ($row = 0; $row < 9; $row++) {
            $totalCols += pow($puzzle[$row][$col], 2);
        }

        return $totalCols === $checksum;
    }

    /**
     * Checks if a given subsquare is valid
     * @param array $puzzle
     * @param int   $index
     * @return bool
     */
    private function checkSquare($puzzle, $index)
    {
        $checksum = $this->getCheckSum();
        $totalSquares = 0;
        for ($elem = 0; $elem < 9; $elem++) {
            $squareRow = intval($elem / 3) + intval($index / 3) * 3;
            $squareCol = $elem % 3 + ($index % 3) * 3;
            $totalSquares += pow($puzzle[$squareRow][$squareCol], 2);
        }

        return $totalSquares === $checksum;
    }

    /**
     * Returns the checksum that defines a valid row, column or square.
     *
     * @return int
     */
    private function getCheckSum()
    {
        static $checksum = 0;
        if ($checksum == 0) {
            for ($i = 1; $i <= 9; $i++) {
                $checksum += $i * $i;
            }
        }

        return $checksum;
    }
}