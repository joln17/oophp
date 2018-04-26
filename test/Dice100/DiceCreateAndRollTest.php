<?php

namespace Joln\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceCreateAndRollTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Joln\Dice100\Dice", $dice);

        $dice->roll();
        $res = $dice->getLastFaceValue();
        $this->assertGreaterThanOrEqual(1, $res);
        $this->assertLessThanOrEqual(6, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use one argument.
     */
    public function testCreateObjectOneArgument()
    {
        $dice = new Dice(10);
        $this->assertInstanceOf("\Joln\Dice100\Dice", $dice);

        $dice->roll(100);
        $res = $dice->getFaceValues();
        $this->assertCount(100, $res);
        foreach ($res as $value) {
            $this->assertGreaterThanOrEqual(1, $value);
            $this->assertLessThanOrEqual(10, $value);
        }
    }
}
