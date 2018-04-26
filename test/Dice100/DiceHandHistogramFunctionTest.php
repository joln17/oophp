<?php

namespace Joln\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHandHistogram.
 */
class DiceHandHistogramFunctionTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetHistogram()
    {
        $diceHand = new DiceHandHistogram();

        $diceHand->rollDiceHand();

        $res = $diceHand->getHistogramMin();
        $this->assertEquals(1, $res);

        $res = $diceHand->getHistogramMax();
        $this->assertEquals(6, $res);

        $exp = $diceHand->getFaceValues();
        $res = $diceHand->getHistogramSerie();
        $this->assertEquals($exp, $res);
    }
}
