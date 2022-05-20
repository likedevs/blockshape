<?php

namespace App;

use Terranet\Administrator\Repository;

class Cart extends Repository
{
    public $fillable = ['user_id', 'prod_id', 'order_id', 'type', 'price', 'paid', 'order_id'];

    public $table = 'cart';

    public function subscriptions()
    {
        return $this->hasOne(MSubscription::class, 'id', 'prod_id');
    }

    public function events()
    {
        return $this->hasOne(MEvents::class, 'id', 'prod_id');
    }

    public function seminars()
    {
        return $this->hasOne(MSeminars::class, 'id', 'prod_id');
    }
}
