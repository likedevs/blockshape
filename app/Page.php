<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Terranet\Administrator\Repository;

class Page extends Repository implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = ['site_id', 'title', 'slug', 'body'];

    protected $sluggable = [
        'save_to'    => 'slug',
        'build_from' => 'title',
        'on_update'  => true
    ];
}
