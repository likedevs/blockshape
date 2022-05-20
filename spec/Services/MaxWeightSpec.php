<?php

namespace spec\App\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MaxWeightSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Services\MaxWeight');
    }

    public function it_calculates_for_168_and_36()
    {
        $this->calculate(168, 36)->shouldBe(57.0);
    }

    public function it_calculates_for_173_and_33()
    {
        $this->calculate(173, 33)->shouldBe(59.0);
    }
}
