<?php

namespace app\tests;


use app\SudokuChecker;


class SudokuCheckerTest extends \PHPUnit_Framework_TestCase
{
    public function testStub()
    {
        $this->assertTrue(true);
        $this->assertEquals('app\SudokuChecker', get_class(SudokuChecker::getInstance()));
    }
}
