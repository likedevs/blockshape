<?php namespace App\Services;

use App\Exercise;

class PulseMapper
{
    /**
     * @var Exercise $exercise
     */
    private $exercise;

    private $map;

    /**
     * @param Exercise $exercise
     * @param          $pulse
     * @return
     * @throws \Exception
     */
    public function findMax(Exercise $exercise, $pulse)
    {
        $this->exercise = $exercise;

        $map = $this->getMap();

        $pulse = $this->normalize($pulse);

        return $map->getAttribute("p_{$pulse}");
    }

    private function getMap()
    {
        if (null === $this->map || $this->map->exercise_id !== $this->exercise->id) {
            $this->map = $this->exercise->pulseMap;
        }

        return $this->map;
    }

    private function normalize($pulse)
    {
        $pulse = round($pulse / 10, 0) * 10;

        return $pulse;
    }
}