<?php

namespace spec\App\Nutrition\Load;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WeightGainSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('App\Nutrition\Load\WeightGain');
    }

    public function let()
    {

    }

    function it_calculates_weight_gain_schedule_for_8_00()
    {
        $schedule = $this->schedule("08:00");

        $schedule['07:00']->shouldBe('main:carbohydrates');

        $schedule['08:00']->shouldBe('water');

        $schedule['10:00']->shouldBe('main:proteins-carbohydrates');

        $schedule['12:00']->shouldMatch('~^snack:(carbohydrates|proteins)$~i');
        $schedule['13:00']->shouldMatch('~^main:(carbohydrates|vegetables-carbohydrates)$~i');
        $schedule['15:00']->shouldMatch('~^snack:(carbohydrates|proteins)$~i');
        $schedule['16:00']->shouldBe('main:carbohydrates');
        $schedule['18:00']->shouldMatch('~^snack:(carbohydrates|proteins)$~i');
    }
}
