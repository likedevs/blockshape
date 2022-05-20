<?php

namespace App;

use Terranet\Administrator\Repository;

class MotivationList extends Repository
{
    public $fillable = ['user_id', 'text'];

    public $table = 'media_motivational_lists';

}
