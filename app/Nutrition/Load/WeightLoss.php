<?php

namespace App\Nutrition\Load;

class WeightLoss extends AbstractDriver
{
    protected $hourMin = 7;

    protected $hourMax = 18;

    protected $eatingsNumber = 5;

    // if workout outside of 7 - 18: time schedule is like in rest day
    // workout 8 -> first main eating: 6:00
    protected $rules = [
        -11 => [
            'type'      => 'main',
            'nutrients' => ['proteins-carbohydrates', 'carbohydrates']
        ],
        -9  => [
            'type'      => 'snack',
            'nutrients' => ['proteins']
        ],
        -7  => [
            'type'      => 'main',
            'nutrients' => ['proteins-carbohydrates', 'carbohydrates']
        ],
        -5  => [
            'type'      => 'snack',
            'nutrients' => ['carbohydrates', /*'vegetables-carbohydrates',*/ 'proteins']
        ],
        -2  => [
            'type'      => 'main',
            'nutrients' => ['carbohydrates'/*, 'vegetables-carbohydrates'*/]
        ],
        0   => 'water',
        2   => [
            'type'      => 'main',
            'nutrients' => ['carbohydrates'/*, 'vegetables-carbohydrates'*/]
        ],
        5   => [
            'type'      => 'snack',
            'nutrients' => ['carbohydrates', 'proteins']
        ],
        7   => [
            'type'      => 'main',
            'nutrients' => ['proteins-carbohydrates', 'carbohydrates'/*, 'vegetables-carbohydrates'*/]
        ],
        9   => [
            'type'      => 'snack',
            'nutrients' => ['proteins']
        ],
        11  => [
            'type'      => 'main',
            'nutrients' => ['proteins-carbohydrates', 'carbohydrates']
        ]
    ];
}