<?php namespace App\Repositories;

class TargetsRepository extends Repository
{
    public function all($columns = ['id', 'name'])
    {
        return $this->createModel()->orderBy('id')->get($columns);
    }
}