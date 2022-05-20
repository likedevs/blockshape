<?php

namespace App;

use Terranet\Administrator\Repository;

class Product extends Repository
{
    public $timestamps = false;

    protected $filled = ['name'];
}
