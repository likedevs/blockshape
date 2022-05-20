<?php

namespace App;

use Terranet\Administrator\Repository;
use Terranet\Rankable\HasRankableField;
use Terranet\Rankable\Rankable;

class GeneralRecommendation extends Repository implements Rankable
{
    use HasRankableField;

    public $timestamps = false;

    protected $fillable = ['body', 'rank'];
}
