<?php

namespace spec\App\BMICalculator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ValueByAgeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\BMICalculator\ValueByAge');
    }

    public function it_gets_18_for_15_20()
    {
        $this->get(15)->shouldBe(18);
        $this->get(17)->shouldBe(18);
        $this->get(20)->shouldBe(18);
    }

    public function it_gets_18_5_for_21_25()
    {
        $this->get(21)->shouldBe(18.5);
        $this->get(22)->shouldBe(18.5);
        $this->get(25)->shouldBe(18.5);
    }

    public function it_gets_21_for_41_45()
    {
        $this->get(41)->shouldBe(21);
        $this->get(43)->shouldBe(21);
        $this->get(45)->shouldBe(21);
    }
}
