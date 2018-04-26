<?php

namespace Joln\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice100.
 */
class Dice100PlayTest extends TestCase
{
    /**
     * Test play
     */
    public function testPlay()
    {
        $game = new Dice100();

        $points = $game->play();
        $this->assertGreaterThanOrEqual(0, $points);
        $this->assertLessThanOrEqual(6, $points);

        $res = $game->getFaceValues();
        $diceHand = $game->getDiceHand();
        $faceValue = $diceHand->getFaceValues();
        $this->assertEquals($faceValue, $res[0]);

        $this->assertGreaterThanOrEqual(1, $res[0][0]);
        $this->assertLessThanOrEqual(6, $res[0][0]);
    }



    /**
     * Test stop
     */
    public function testStop()
    {
        $game = new Dice100();

        $points = $game->play();
        $game->stop();
        $score = $game->getScore();
        $this->assertEquals($points, $score['player']);

        $res = $game->getPoints();
        $this->assertEquals(0, $res);
    }



    /**
     * Test computerplay
     */
    public function testComputerPlay()
    {
        $game = new Dice100();

        $points = $game->computerPlay();
        $score = $game->getScore();
        $this->assertEquals($points, $score['computer']);
        $this->assertLessThanOrEqual(26, $score['computer']);

        $res = $game->getPoints();
        $this->assertEquals(0, $res);
    }



    /**
     * Test winner
     */
    public function testWinner()
    {
        $game = new Dice100();

        $res = $game->checkWinner();
        $this->assertNull($res);
    }
}
