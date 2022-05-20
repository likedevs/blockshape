<?php

namespace App;

use Terranet\Administrator\Repository;

class MMessages extends Repository
{
    public $fillable = ['user_id', 'body', 'from'];

    public $table = 'media_messages';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
