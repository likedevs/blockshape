<?php namespace App;

use Terranet\Administrator\Repository;
use Terranet\Rankable\HasRankableField;
use Terranet\Rankable\Rankable;

class Exercise extends Repository implements Rankable
{
    use HasRankableField;

    public $timestamps = false;

    protected $fillable = ['name'];

    /**
     * Pulse reference map
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pulseMap()
    {
        return $this->hasOne(ExercisePressureMap::class);
    }
}