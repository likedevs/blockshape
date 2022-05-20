<?php

namespace App;

use Terranet\Administrator\Repository;

class MOrder extends Repository
{
    public $fillable = ['user_id', 'status', 'amount'];

    public $table = 'media_orders';

    public function subscriptions()
    {
        return $this->hasMany(Cart::class, 'id', 'order_id');
    }

}
