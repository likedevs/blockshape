<?php namespace App;

use Terranet\Administrator\Repository;

class PressureMap extends Repository
{
    protected $table = 'exercise_pressure_map';

    public $timestamps = false;

    /**
     * Exercise Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
