<?php

namespace App;

use Terranet\Administrator\Repository;

class Nutrient extends Repository
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function referenceGroups()
    {
        return $this->hasMany(ReferenceGroup::class);
    }
}