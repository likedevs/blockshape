<?php namespace App\BMICalculator;

abstract class AbstractCalculator
{
    /**
     * @param $height
     * @return int
     */
    protected function normalizeHeight($height)
    {
        // transform centimeters to meters
        if ($height > 100) {
            $height /= 100;
        }

        return $height;
    }
}