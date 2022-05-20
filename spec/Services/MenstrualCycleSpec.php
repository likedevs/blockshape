<?php

namespace spec\App\Services;

use Carbon\Carbon;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MenstrualCycleSpec extends ObjectBehavior
{
    function it_calculates_periods_for_next_month()
    {
        // base date 2015-10-10,
        // cycle started at 8 with duration 28
        $this->setReturnType('String')->parse(8, 28, Carbon::createFromDate(2015, 10, 10))->shouldReturn([
            '2015-11-05',
            '2015-11-08',
            '2015-11-18',
            '2015-12-03',
        ]);
    }

    function it_calculates_periods_for_previous_month()
    {
        // base date 2015-10-10,
        // cycle started at 20 with duration 28
        $this->setReturnType('String')->parse(20, 28, Carbon::createFromDate(2015, 10, 10))->shouldReturn([
            '2015-10-18',
            '2015-10-21',
            '2015-10-31',
            '2015-11-15'
        ]);
    }

    function it_calculates_periods_for_random_date()
    {
        // base date 2015-10-23,
        // cycle started at 20 with duration 28
        $this->setReturnType('String')->parse(15, 30, Carbon::createFromDate(2015, 10, 23))->shouldReturn([
            '2015-11-14',
            '2015-11-17',
            '2015-11-27',
            '2015-12-14'
        ]);
    }
}