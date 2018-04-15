<?php
namespace Joln\Dice100;

/**
 * Class for Dice100
 */
class Dice100
{
    /** @var int GAME_SCORE    The score to reach in the game */
    const GAME_SCORE = 100;

    /** @var object $diceHand    A DiceHand object */
    private $diceHand;

    /** @var array $faceValues    Array with face values for the dice rolls */
    private $faceValues = [];

    /** @var array $score    Array with total score for player and computer */
    private $score = [];

    /** @var int $points    Points in current game */
    private $points = 0;



    /**
     * Constructor to create a Game
     *
     * @param int $numberOfDices    Number of dices, default 1.
     */
    public function __construct(int $numberOfDices = 1)
    {
        $this->diceHand = new DiceHand($numberOfDices);
        $this->score['player'] = 0;
        $this->score['computer'] = 0;
    }



    /**
     * Calculate points from dice face values
     *
     * @param array $faceValues    Array with dice face values.
     *
     * @return int    Points from the dice face values.
     */
    private function calculatePoints($faceValues)
    {
        $points = 0;
        if (!in_array(1, $faceValues)) {
            $points = array_sum($faceValues);
        }
        return $points;
    }



    /**
     * Roll a dice hand and calculate points
     *
     * @return int    Points from the current game.
     */
    public function play()
    {
        if ($this->points == 0) {
            $this->faceValues = [];
        }
        $this->diceHand->rollDiceHand();
        $this->faceValues[] = $this->diceHand->getFaceValues();
        $points = $this->calculatePoints($this->diceHand->getFaceValues());
        if ($points == 0) {
            $this->points = 0;
        } else {
            $this->points += $points;
        }
        return $this->points;
    }



    /**
     * Stop current game for the player and add points to the total score
     *
     * @return void
     */
    public function stop()
    {
        $this->score['player'] += $this->points;
        $this->points = 0;
    }



    /**
     * Simulate play by computer and add points to the total score
     *
     * @return int    Points from the game.
     */
    public function computerPlay()
    {
        do {
            $points = $this->play();
        } while ($points != 0 && $points < 20 && $this->score['computer'] + $points < self::GAME_SCORE);
        $this->score['computer'] += $points;
        $this->points = 0;
        return $points;
    }



    /**
     * Check if the player or computer has reached the target GAME_SCORE
     *
     * @return string|null    The winner or null if no winner.
     */
    public function checkWinner()
    {
        $winner = null;
        if ($this->score['player'] >= self::GAME_SCORE) {
            $winner = 'player';
        }
        if ($this->score['computer'] >= self::GAME_SCORE) {
            $winner = 'computer';
        }
        return $winner;
    }



    /**
     * Get the dice face values from current game
     *
     * @return array    Array with the face values.
     */
    public function getFaceValues()
    {
        return $this->faceValues;
    }



    /**
     * Get the points from the current game
     *
     * @return int    Points from the game.
     */
    public function getPoints()
    {
        return $this->points;
    }



    /**
     * Get the total scores for player and computer
     *
     * @return array    Array with total scores.
     */
    public function getScore()
    {
        return $this->score;
    }
}
