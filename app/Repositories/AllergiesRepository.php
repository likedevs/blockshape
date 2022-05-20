<?php namespace App\Repositories;

class AllergiesRepository extends Repository
{
    /**
     * Fetch the whole available allergies
     *
     * @return mixed
     */
    public function all()
    {
        return $this->createModel()->orderBy('name')->get();
    }
}