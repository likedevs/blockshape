<?php namespace App;

use Terranet\Administrator\Repository;

class ReferenceGroup extends Repository
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(ReferenceProduct::class, 'group_id');
    }

    public function nutrient()
    {
        return $this->belongsTo(Nutrient::class);
    }
}
