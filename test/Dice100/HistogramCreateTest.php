<?php

namespace Joln\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Histogram.
 */
class HistogramCreateTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testHistogram()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Joln\Dice100\Histogram", $histogram);

        $diceHand = new DiceHandHistogram();
        $diceHand->rollDiceHand();
        $histogram->injectData($diceHand);
        $exp = $diceHand->getHistogramSerie();
        $res = $histogram->getSerie();
        $this->assertEquals($exp, $res);

        $expString = "";
        $resString = $histogram->getAsText();
        for ($i = 1; $i <= 6; $i++) {
            $expString .= $i . ": ";
            foreach ($exp as $value) {
                $expString .= ($value == $i) ? "*" : "";
            }
            $expString .= "\n";
        }
        $this->assertEquals($expString, $resString);
    }
}
