<?php

namespace App\Repositories;

class PressureTypesRepository extends Repository
{
    public function all()
    {
        return $this->createModel()->orderBy('name')->get(['id', 'name']);
    }
}