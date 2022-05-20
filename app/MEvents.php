<?php

namespace App;

use Terranet\Administrator\Repository;

class MEvents extends Repository
{
    protected $table = "media_events";

    protected $fillable = ['lag_id', 'slug', 'title', 'descr', 'body', 'image', 'price', 'email', 'begin', 'end'];
}
