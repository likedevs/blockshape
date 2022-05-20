<?php

namespace App;

use Terranet\Administrator\Repository;
use Terranet\Rankable\HasRankableField;
use Terranet\Rankable\Rankable;

class QuizAnswer extends Repository implements Rankable
{
    use HasRankableField;

    protected $rankableGroupByColumn = 'group_id';

    public $timestamps = false;

    /**
     * Quiz Answer belongs to a Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(QuizAnswersGroup::class);
    }
}
