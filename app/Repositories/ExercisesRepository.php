<?php namespace App\Repositories;

class ExercisesRepository extends Repository
{
    /**
     * Get full list of exercises
     *
     * @param bool $withPulseMap
     * @return mixed
     */
    public function all($withPulseMap = false)
    {
        $query = $this->createModel()->orderBy('rank');

        if ($withPulseMap) {
            $query->with('pulseMap');
        }

        return $query->get();
    }
}