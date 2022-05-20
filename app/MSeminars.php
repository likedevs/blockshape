<?php

namespace App;

use Terranet\Administrator\Repository;

class MSeminars extends Repository
{
    protected $table = "media_seminars";

    protected $fillable = ['lag_id', 'slug', 'title', 'desc', 'body', 'image', 'price', 'avantage_1', 'avantage_2', 'avantage_3', 'avantage_4', 'avantage_5', 'email', 'begin', 'end'];
}
