<?php

namespace App;

use Terranet\Administrator\Repository;

class MUserFood extends Repository
{
    public $fillable = ['user_diary_id', 'food', 'time', 'qty'];

    public $table = 'media_user_foods';

}
