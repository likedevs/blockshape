<?php

namespace App;

use Terranet\Administrator\Repository;
use Terranet\Rankable\HasRankableField;
use Terranet\Rankable\Rankable;

class QuizQuestion extends Repository implements Rankable
{
    use HasRankableField;

    public $timestamps = false;

    /**
     * Question belongs to Answer Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answerGroup()
    {
        return $this->belongsTo(QuizAnswersGroup::class);
    }

    public function answers()
    {
        return $this->answerGroup->answers();
    }
}