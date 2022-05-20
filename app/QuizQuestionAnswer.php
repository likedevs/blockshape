<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestionAnswer extends Model
{
    public $timestamps = false;

    protected $fillable = ['question_id', 'answer_id', 'hint_id'];
}
