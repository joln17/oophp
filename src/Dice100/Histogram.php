<?php

namespace Joln\Dice100;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    private $min;
    private $max;



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }



    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $histogram = "";
        $serieCount = array_count_values($this->serie);
        ksort($serieCount);
        for ($i = $this->min; $i <= $this->max; $i++) {
            $histogram .= $i . ": ";
            if (array_key_exists($i, $serieCount)) {
                $histogram .= str_repeat("*", $serieCount[$i]);
            }
            $histogram .= "\n";
        }
        return $histogram;
    }



    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        $this->serie = $object->getHistogramSerie();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }
}
