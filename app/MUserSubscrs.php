<?php

namespace App;

use Terranet\Administrator\Repository;

class MUserSubscrs extends Repository
{
    public $fillable = ['user_id', 'begin', 'end'];

    public $table = 'media_users_subscriptions';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
