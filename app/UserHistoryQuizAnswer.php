<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHistoryQuizAnswer extends Model
{
    public $timestamps = false;

    protected $fillable = ['question_id', 'answer_id'];

    public function question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }

    public function answer()
    {
        return $this->belongsTo(QuizAnswer::class);
    }
}
