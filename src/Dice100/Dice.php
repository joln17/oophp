<?php
namespace Joln\Dice100;

/**
 * Class for Dice
 */
class Dice
{
    /** @var int $sides     Number of sides for the dice */
    private $sides;

    /** @var int $rolls    Number of rolls */
    private $rolls = 0;

    /** @var array $faceValues    Face values from the dice rolls */
    private $faceValues = [];

    /**
     * Constructor to create a Dice
     *
     * @param int $sides    Number of sides, default 6.
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }



    /**
     * Roll the dice and generate face values
     *
     * @param int $rolls    Number of rolls.
     *
     * @return void
     */
    public function roll(int $rolls = 1)
    {
        $this->rolls += $rolls;
        for ($i = 1; $i <= $rolls; $i++) {
            $this->faceValues[] = rand(1, $this->sides);
        }
    }



    /**
     * Get face values of the dice rolls
     *
     * @return array    Array with the face values
     */
    public function getFaceValues()
    {
        return $this->faceValues;
    }



    /**
     * Get last face value of the dice rolls
     *
     * @return int    Last face value
     */
    public function getLastFaceValue()
    {
        return end($this->faceValues);
    }



    /**
     * Get the sum of the face values
     *
     * @return int    Sum of the face values
     */
    public function sum()
    {
        return array_sum($this->faceValues);
    }



    /**
     * Get the average of the face values
     *
     * @return float    Average of the face values
     */
    public function average()
    {
        return array_sum($this->faceValues) / $this->rolls;
    }
}
