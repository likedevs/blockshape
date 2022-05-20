<?php

namespace App;

use Terranet\Administrator\Repository;

class MBlockImage extends Repository
{
    protected $table = "media_blocks_image";

    protected $fillable = ['page_id', 'lang_id', 'body'];

    public function page(){
        return $this->hasOne(MPages::class, 'id', 'page_id');
    }

}
