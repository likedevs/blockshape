<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Terranet\Administrator\Model\Language;
use Terranet\Administrator\Repository;


class MCabinetPages extends Repository
{
    protected $table = 'media_cabinet_pages';

    protected $fillable = ['slug', 'name', 'class'];

}
