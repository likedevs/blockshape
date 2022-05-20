<?php

namespace spec\App\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasalMetabolismSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Services\BasalMetabolism');
    }

    function it_calculates_basal_rate_for_different_sets_of_values()
    {
        $this->calculate(76, 173, 33)->shouldBe(1230);
        $this->calculate(70, 173, 33)->shouldBe(1173);
        $this->calculate(67, 173, 33)->shouldBe(1144);
    }
}
