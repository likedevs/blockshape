<?php

namespace App;

use Terranet\Administrator\Repository;

class MUserTraining extends Repository
{
    public $fillable = ['user_diary_id', 'time', 'duration'];

    public $table = 'media_user_trainings';
}
