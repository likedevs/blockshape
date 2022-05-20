<?php namespace App\Repositories;

class ExcludesRepository extends Repository
{
    /**
     * Fetch all available product excludes
     *
     * @return mixed
     */
    public function all()
    {
        return $this->createModel()->orderBy('name')->get();
    }
}