<?php

namespace App\Convert;

class MinsToTime implements Convert
{
    protected $value;

    /**
     * @param $minutes
     */
    public function __construct($minutes)
    {
        $hours = floor($minutes / 60);
        $minutes = $minutes - ($hours * 60);

        list($hours, $minutes) = $this->normalizeTime($hours, $minutes);

        $this->value = "{$hours}:{$minutes}";
    }

    protected function normalizeTime($hours, $minutes)
    {
        return [str_pad($hours, 2, '0', STR_PAD_LEFT), str_pad($minutes, 2, '0', STR_PAD_LEFT)];
    }

    public function convert()
    {
        return $this->value;
    }
}