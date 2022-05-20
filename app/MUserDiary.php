<?php

namespace App;

use Terranet\Administrator\Repository;

class MUserDiary extends Repository
{
    public $fillable = ['user_id', 'menstruation_start', 'date', 'wake', 'water_qty', 'weight_body', 'detection_qty', 'detection_slidity', 'puls', 'period', 'empty', 'buttocks', 'waist', 'arm', 'thigh', 'abdomen'];

    public $table = 'media_user_diary';

    public function foods()
    {
        return $this->hasMany(MUserFood::class, 'user_diary_id', 'id');
    }

    public function trainings()
    {
        return $this->hasMany(MUserTraining::class, 'user_diary_id', 'id');
    }
}
