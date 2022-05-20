<?php

namespace App;

use Terranet\Administrator\Repository;

class PressureType extends Repository
{
    public $timestamps = false;

    protected $fillable = ['name', 'note'];
}
