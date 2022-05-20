<?php namespace App\BMICalculator;

class ValueByAge
{
    /**
     * Get recommended IMC by customer age
     *
     * @param $age
     * @return float
     */
    public static function get($age)
    {
        $reference = [
            '15-20' => 18,
            '21-25' => 18.5,
            '26-30' => 19,
            '31-35' => 19.5,
            '36-40' => 20,
            '41-45' => 21,
            '46-50' => 22,
            '51-60' => 23
        ];

        foreach ($reference as $ages => $imc) {
            list($min, $max) = explode('-', $ages);
            if ($age >= $min && $age <= $max) {
                return $imc;
            }
        }

        return 21.75;
    }
}