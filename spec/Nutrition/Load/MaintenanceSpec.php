<?php

namespace spec\App\Nutrition\Load;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MaintenanceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Nutrition\Load\Maintenance');
    }
}
