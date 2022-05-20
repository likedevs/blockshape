<?php

namespace App\Services\Responses;

use App\Services\Contracts\CardioReactionDetector AS Detector;

class CardioReaction
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function id()
    {
        $map = [
            1 => Detector::R_NORMOTONIE . '-' . Detector::R_NORMOTONIE,
            2 => Detector::R_HIPOTONIE . '-' . Detector::R_NORMOTONIE,
            3 => Detector::R_HIPOTONIE . '-' . Detector::R_HIPERTONIE,
            4 => Detector::R_HIPERTONIE . '-' . Detector::R_ATTENTION,
            5 => Detector::R_NORMOTONIE . '-' . Detector::R_HIPERTONIE
        ];

        if (false == ($id = array_search($this->value, $map, true))) {
            throw new \Exception(sprintf('Can not resolve %s', $this->value));
        }

        return $id;
    }

    public function toString()
    {
        return (string) $this;
    }

    public function __toString()
    {
        return $this->value;
    }
}