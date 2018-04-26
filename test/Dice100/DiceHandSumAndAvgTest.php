<?php

namespace Joln\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHandSumAndAvgTest extends TestCase
{
    /**
     * Test sum function of DiceHand class
     */
    public function testSum()
    {
        $diceHand = new DiceHand();
        $diceHand->rollDiceHand();
        $faceValues = $diceHand->getFaceValues();
        $res = $diceHand->sum();
        $this->assertEquals(array_sum($faceValues), $res);
    }



    /**
     * Test avg function of DiceHand class
     */
    public function testAverage()
    {
        $diceHand = new DiceHand();
        $diceHand->rollDiceHand();
        $faceValues = $diceHand->getFaceValues();
        $res = $diceHand->average();
        $this->assertEquals(array_sum($faceValues) / 5, $res);
    }
}
