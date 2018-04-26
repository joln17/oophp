<?php

namespace Joln\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceSumAndAvgTest extends TestCase
{
    /**
     * Test sum function of Dice class
     */
    public function testSum()
    {
        $dice = new Dice();
        $dice->roll(100);
        $faceValues = $dice->getFaceValues();
        $res = $dice->sum();
        $this->assertEquals(array_sum($faceValues), $res);
    }



    /**
     * Test avg function of Dice class
     */
    public function testAverage()
    {
        $dice = new Dice();
        $dice->roll(100);
        $faceValues = $dice->getFaceValues();
        $res = $dice->average();
        $this->assertEquals(array_sum($faceValues) / 100, $res);
    }
}
