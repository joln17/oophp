<?php

namespace Joln\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice100.
 */
class Dice100CreateTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $game = new Dice100();
        $this->assertInstanceOf("\Joln\Dice100\Dice100", $game);

        $diceHand = $game->getDiceHand();
        $this->assertInstanceOf("\Joln\Dice100\DiceHandHistogram", $diceHand);

        $res = $game->getPoints();
        $this->assertEquals(0, $res);

        $res = $game->getScore();
        $this->assertEquals(0, $res['player']);
        $this->assertEquals(0, $res['computer']);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use one argument.
     */
    public function testCreateObjectOneArgument()
    {
        $game = new Dice100(5);
        $this->assertInstanceOf("\Joln\Dice100\Dice100", $game);

        $diceHand = $game->getDiceHand();
        $this->assertInstanceOf("\Joln\Dice100\DiceHandHistogram", $diceHand);

        $res = $game->getPoints();
        $this->assertEquals(0, $res);

        $res = $game->getScore();
        $this->assertEquals(0, $res['player']);
        $this->assertEquals(0, $res['computer']);
    }
}
