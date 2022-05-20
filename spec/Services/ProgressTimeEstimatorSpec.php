<?php

namespace spec\App\Services;

use App\Services\ProgressTimeEstimator\EstimatedTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProgressTimeEstimatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Services\ProgressTimeEstimator');
    }

    public function it_estimates_76_70_as_2()
    {
        $this->estimate(76, 70)->getValues()->shouldBe([2]);
    }

    public function it_estimates_82_57_as_9()
    {
        $this->estimate(82, 57)->getValues()->shouldBe([8, 9]);
    }
}
