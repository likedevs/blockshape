<?php

namespace App\Services\Contracts;

use App\Order;

interface Gateway
{
    /**
     * Prepare the order for processing
     *
     * @return Order
     */
    public function prepare();
}