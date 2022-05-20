<?php namespace App\Repositories;

class FigureTypesRepository extends Repository
{
    /**
     * Fetch full list of Constitution types
     *
     * @return mixed
     */
    public function all()
    {
        return $this->createModel()->orderBy('name')->get(['id', 'name', 'image']);
    }
}