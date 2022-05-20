<?php namespace App;

use Terranet\Administrator\Repository;

class Office extends Repository
{
    public $timestamps = false;

    protected $fillable = ['name', 'address'];

    public function instructors()
    {
        return $this->belongsToMany(User::class)->instructor();
    }
}
