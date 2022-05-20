<?php namespace App;

use Terranet\Administrator\Repository;

class ReferenceProduct extends Repository
{
    public $timestamps = false;

    protected $fillable = ['name', 'proteins', 'lipids', 'disaccharides', 'starch', 'energy_value'];

    protected $casts = [
        'proteins'      => 'double',
        'lipids'        => 'double',
        'disaccharides' => 'double',
        'starch'        => 'double',
        'energy_value'  => 'double',
    ];

    public function group()
    {
        return $this->belongsTo(ReferenceGroup::class);
    }
}