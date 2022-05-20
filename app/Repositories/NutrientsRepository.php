<?php namespace App\Repositories;

class NutrientsRepository extends Repository
{
    public function all()
    {
        return $this->createModel()->has('referenceGroups.products')->get();
    }
}