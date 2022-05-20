<?php

namespace App;

use Terranet\Administrator\Repository;

class QuizAnswersGroup extends Repository
{
    public $timestamps = false;

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class, 'group_id');
    }
}
