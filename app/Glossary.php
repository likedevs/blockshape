<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Terranet\Administrator\Repository;

class Glossary extends Repository
{
    protected $table = 'glossary';

    protected $fillable = ['title', 'slug', 'body', 'widget'];
}
