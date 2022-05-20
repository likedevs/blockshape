<?php

namespace App;

use Illuminate\Http\Request;
use Terranet\Administrator\Repository;

class Video extends Repository
{
    protected $fillable = [
        'name', 'instructor_id', 'file'
    ];

    protected $table = 'videos';

    public function instructor()
    {
        return $this->hasOne(Instructor::class, 'id', 'instructor_id');
    }

}
