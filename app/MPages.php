<?php

namespace App;

use Terranet\Administrator\Repository;

class MPages extends Repository
{
    protected $table = "media_pages";

    protected $fillable = ['slug', 'name', 'lang_id', 'is_home', 'is_menu'];

    public function TextsBlocks()
    {
        return $this->hasMany(MBlockText::class, 'page_id', 'id')->where('type', 'text');
    }

    public function ImagesBlocks()
    {
        return $this->hasMany(MBlockImage::class, 'page_id', 'id');
    }
}
