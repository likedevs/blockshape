<?php

namespace App\Services\Gateway;

use App\Order;
use App\Services\Contracts\Gateway;
use Carbon\Carbon;

class Qiwi extends AbstractGateway implements Gateway
{
    /**
     * Prepare the order for processing
     *
     * @return Order
     */
    public function prepare()
    {
        return $this->orders->save($this->order, [
            'order_id'   => $this->buildId(),
            'expires_at' => $this->buildExpiresAt()
        ]);
    }

    /**
     * @return int
     */
    protected function buildId()
    {
        return $this->orders->buildOrderId();
    }

    /**
     * @return mixed
     */
    protected function buildExpiresAt()
    {
        return Carbon::now()->addHours(72);
    }
}