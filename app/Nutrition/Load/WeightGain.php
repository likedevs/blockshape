<?php

namespace App\Nutrition\Load;

class WeightGain extends AbstractDriver
{
    protected $hourMin = 7;

    protected $hourMax = 20;

    protected $eatingsNumber = 7;

    protected $rules = [
        -14 => [
            'type' => 'main',
            'nutrients' => ['carbohydrates'/*, 'vegetables-carbohydrates'*/]
        ],
        -12 => [
            'type' => 'snack',
            'nutrients' => ['carbohydrates', 'proteins']
        ],
        -10 => [
            'type' => 'main',
            'nutrients' => ['carbohydrates']
        ],
        -8 => [
            'type' => 'snack',
            'nutrients' => ['carbohydrates', 'proteins']
        ],
        -6 => [
            'type' => 'main',
            'nutrients' => [/*'vegetables-carbohydrates', */'carbohydrates']
        ],
        -4 => [
            'type' => 'snack',
            'nutrients' => ['carbohydrates', 'proteins']
        ],
        -2 => [
            'type' => 'main',
            'nutrients' => ['carbohydrates']
        ],
        0 => 'water', /*'carbohydrates'*/
        2 => [
            'type' => 'main',
            'nutrients' => ['proteins-carbohydrates']
        ],
        4 => [
            'type' => 'snack',
            'nutrients' => ['carbohydrates', 'proteins']
        ],
        6 => [
            'type' => 'main',
            'nutrients' => [/*'vegetables-carbohydrates', */'carbohydrates']
        ],
        8 => [
            'type' => 'snack',
            'nutrients' => ['carbohydrates', 'proteins']
        ],
        10 => [
            'type' => 'main',
            'nutrients' => ['carbohydrates']
        ],
        12 => [
            'type' => 'snack',
            'nutrients' => ['carbohydrates', 'proteins']
        ],
        14 => [
            'type' => 'main',
            'nutrients' => ['carbohydrates'/*, 'vegetables-carbohydrates'*/]
        ]
    ];

    protected function fixNutrients($shiftHours, $type)
    {
        if ($this->positiveShift($shiftHours) && 'main' == $type) {
            $hour = $this->hour($this->time);

            // when it's too late for main eating (ex: after 20:00)
            // try to recommend a snack that should go after expected main
            if (($hour + $shiftHours + 1) >= $this->hourMax) {
                if ($nextShift = $this->shifts[array_search($shiftHours, $this->shifts) + 1]) {
                    $type = 'snack';
                    $nutrients = $this->rules[$nextShift]['nutrients'];

                    return [$type, $nutrients];
                }
            }
        }

        return null;
    }
}
