<?php namespace App\BMICalculator;

use App\BMICalculator\Contracts\BMICalculator AS CalculatorContract;

class FemaleCalculator extends AbstractCalculator implements CalculatorContract
{
    /**
     * Calculate bmi based on provided measurements
     *
     * @param int $height
     * @param int $weight
     * @return float
     */
    public function calculate($height, $weight)
    {
        $height = $this->normalizeHeight($height);

        return new BMIValue($weight / pow($height, 2));
    }
}