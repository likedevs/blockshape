<?php

namespace App;

use Terranet\Administrator\Repository;

class FigureType extends Repository
{
    public $timestamps = false;

    protected $fillable = ['name', 'description'];

    protected $casts = [
        'description' => 'json'
    ];

    public function getDescription($scope)
    {
        return $this->description[$scope];
    }
}
