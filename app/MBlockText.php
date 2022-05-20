<?php

namespace App;

use Terranet\Administrator\Repository;

class MBlockText extends Repository
{
    protected $table = "media_blocks_text";

    protected $fillable = ['page_id', 'lang_id', 'body'];

    public function page(){
        return $this->hasOne(MPages::class, 'id', 'page_id');
    }

}
