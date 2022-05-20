<?php

namespace App\Services\Gateway;

use App\Order;
use App\Services\Contracts\Gateway;

class VictoriaBank extends AbstractGateway implements Gateway
{
    /**
     * Prepare the order for processing
     *
     * @return Order
     */
    public function prepare()
    {
        return $this->order;
    }
}