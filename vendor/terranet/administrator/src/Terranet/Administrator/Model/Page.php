<?php namespace Terranet\Administrator\Model;

use Terranet\Administrator\Repository;
use Terranet\Translatable\HasTranslations;
use Terranet\Translatable\Translatable;

class Page extends Repository implements Translatable {

    use HasTranslations;

    protected $translatedAttributes = ['title', 'body'];

    protected $fillable = ['slug', 'title', 'body', 'active'];

}
