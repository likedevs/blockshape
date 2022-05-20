<?php

namespace spec\App\Nutrition\Load;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WeightLossSpec extends ObjectBehavior
{
    function it_calculates_weight_loss_schedule_for_8_00()
    {
        $schedule = $this->schedule('8:00');

        $schedule->shouldHaveCount(6);

        $schedule['06:30']->shouldMatch('~main:(carbohydrates|vegetables-carbohydrates)~si');
        $schedule['08:00']->shouldBe('water');
        $schedule['11:00']->shouldMatch('~main:(carbohydrates|vegetables-carbohydrates)~si');
        $schedule['14:00']->shouldMatch('~snack:(carbohydrates|proteins)~i');
        $schedule['16:00']->shouldMatch('~main:(carbohydrates|proteins-carbohydrates)~i');
        $schedule['18:00']->shouldMatch('~snack:proteins~i');
    }

    function it_calculates_weight_loss_schedule_for_10_00()
    {
        $schedule = $this->schedule('10:00');

        $schedule->shouldHaveCount(6);

        $schedule['06:00']->shouldMatch('~snack:(carbohydrates|vegetables-carbohydrates)$~si');
        $schedule['08:00']->shouldMatch('~main:(carbohydrates|vegetables-carbohydrates)$~si');
        $schedule['10:00']->shouldBe('water');
        $schedule['13:00']->shouldMatch('~^main:(carbohydrates|vegetables-carbohydrates)$~si');
        $schedule['16:00']->shouldMatch('~^snack:(carbohydrates|proteins)$~i');
        $schedule['18:00']->shouldMatch('~^main:(proteins-carbohydrates|carbohydrates)$~i');
    }


    function it_calculates_weight_loss_schedule_for_19_00()
    {
        $schedule = $this->schedule('19:00');

        $schedule->shouldHaveCount(6);

        $schedule['08:00']->shouldMatch('~main:(proteins-carbohydrates|carbohydrates)~i');
        $schedule['10:00']->shouldMatch('~snack:(proteins)~i');
        $schedule['12:00']->shouldMatch('~main:(proteins-carbohydrates)~i');
        $schedule['14:00']->shouldMatch('~snack:(carbohydrates|vegetables-carbohydrates)~i');
        $schedule['17:00']->shouldMatch('~main:(carbohydrates)~si');
        $schedule['19:00']->shouldBe('water');
    }
}
