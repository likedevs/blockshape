<?php

namespace App\Services;

use Carbon\Carbon;

class MenstrualCycle
{
    const TYPE_CARBON = 'Carbon';

    const TYPE_STRING = 'String';

    protected $returnType = self::TYPE_CARBON;

    /**
     * Parse the initial data
     *
     * @param        $dateStart
     * @param        $duration
     * @param Carbon $baseDate
     * @return array
     */
    public function parse($dateStart, $duration, Carbon $baseDate)
    {
        $duration = $this->normalizeDuration($duration);

        $firstDate = Carbon::create($baseDate->year, $baseDate->month, $dateStart);

        // for next month
        if ($dateStart > $baseDate->day) {
            $firstDate->subMonth();
        }
        $firstDate->addDays($duration);

        $p1 = Carbon::parse($firstDate)->addDays(3);
        $p2 = Carbon::parse($firstDate)->addDays(13);
        $p3 = Carbon::parse($firstDate)->addDays($duration);

        return $this->toType([
            $firstDate,
            $p1,
            $p2,
            $p3
        ]);
    }

    private function toType($dates)
    {
        if (static::TYPE_STRING == $this->returnType) {
            return array_map([$this, 'toDateString'], $dates);
        }

        return $dates;
    }

    public function setReturnType($type)
    {
        if (in_array($type, [static::TYPE_CARBON, static::TYPE_STRING])) {
            $this->returnType = $type;
        }

        return $this;
    }

    private function toDateString($data)
    {
        return $data->toDateString();
    }

    private function normalizeDuration($duration)
    {
        if (in_array($duration, [-1, -2])) {
            return 28;
        }

        return $duration;
    }
}