<?php

namespace Joln\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHandHistogram.
 */
class DiceHandHistogramCreateAndRollTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $diceHand = new DiceHandHistogram();
        $this->assertInstanceOf("\Joln\Dice100\DiceHandHistogram", $diceHand);

        $diceHand->rollDiceHand();
        $res = $diceHand->getFaceValues();
        $this->assertCount(5, $res);
        foreach ($res as $value) {
            $this->assertGreaterThanOrEqual(1, $value);
            $this->assertLessThanOrEqual(6, $value);
        }
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use one argument.
     */
    public function testCreateObjectOneArgument()
    {
        $diceHand = new DiceHandHistogram(10);
        $this->assertInstanceOf("\Joln\Dice100\DiceHandHistogram", $diceHand);

        $diceHand->rollDiceHand();
        $res = $diceHand->getFaceValues();
        $this->assertCount(10, $res);
        foreach ($res as $value) {
            $this->assertGreaterThanOrEqual(1, $value);
            $this->assertLessThanOrEqual(6, $value);
        }
    }
}
