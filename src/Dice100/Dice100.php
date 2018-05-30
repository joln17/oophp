<?php
namespace Joln\Dice100;

/**
 * Class for Dice100
 */
class Dice100
{
    /** @var int GAME_SCORE    The score to reach in the game */
    const GAME_SCORE = 100;

    /** @var int $numberOfDices    Number of dices to roll */
    private $numberOfDices;

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
        $this->numberOfDices = $numberOfDices;
        $this->diceHand = new DiceHandHistogram($numberOfDices);
        $this->score['player'] = 0;
        $this->score['computer'] = 0;
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
        $faceValues = $this->diceHand->getFaceValues();
        $this->faceValues[] = $faceValues;

        $points = !in_array(1, $faceValues) ? array_sum($faceValues) : 0;
        $this->points = ($points == 0) ? 0 : $this->points + $points;

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
     * Simulate play by computer and add points to the total score.
     * The computer uses the strategy described in
     * http://cs.gettysburg.edu/~tneller/papers/umap10.pdf on page 17
     *
     * @return int    Points from the game.
     */
    public function computerPlay()
    {
        $optimalPoints = 21 + round(($this->score['player'] - $this->score['computer']) / 8);
        do {
            $points = $this->play();
        } while ($points != 0 && $this->score['computer'] + $points < self::GAME_SCORE &&
            ($this->score['player'] >= 71 || $this->score['computer'] >= 71 || $points < $optimalPoints)
        );
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
     * Get the dice hand from current game
     *
     * @return object    Dice Hand object.
     */
    public function getDiceHand()
    {
        return $this->diceHand;
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
