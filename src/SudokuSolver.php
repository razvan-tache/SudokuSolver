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

    /**
     * SudokuSolver constructor.
     * @param array $puzzle
     */
    public function __construct(array $puzzle)
    {
        $this->puzzle = $puzzle;
    }

    /**
     * @return bool
     */
    public function solve()
    {

        return false;
    }

    /**
     * @return array
     */
    public function getSolution()
    {
        return $this->solution;
    }
}