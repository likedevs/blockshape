<?php

namespace App;

use Terranet\Administrator\Repository;

class MSubscription extends Repository
{
    protected $table = "media_subscriptions";

    protected $fillable = ['lag_id', 'term', 'name', 'price', 'image', 'aditional_image', 'type'];
}
