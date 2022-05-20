<?php
namespace App\Services\Contracts;

interface CardioReactionDetector
{
    const R_NORMOTONIE = 'normotonie';
    const R_HIPOTONIE = 'hipotonie';
    const R_HIPERTONIE = 'hipertonie';
    const R_ATTENTION = 'attention';

    /**
     * Detect pressure type
     *
     * @param $systolic
     * @param $diastolic
     * @return int
     */
    public function detect($systolic, $diastolic);
}