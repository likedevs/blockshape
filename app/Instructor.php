<?php

namespace App;

use Illuminate\Http\Request;
use Terranet\Administrator\Repository;

class Instructor extends Repository
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'instructors';

}
