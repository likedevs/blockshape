<?php namespace Terranet\Administrator\Model;

use Terranet\Administrator\Repository;

class Language extends Repository {

    protected $fillable = ['slug', 'title', 'active', 'rank'];

    public $timestamps = false;

}