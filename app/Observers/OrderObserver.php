<?php

namespace App\Observers;

use App\Order;

class OrderObserver
{
    /**
     * Manage order finances while creating
     * Note: Update login is handled by UserHistoryObserver
     *
     * @param $order
     * @return mixed
     */
    public function creating($order)
    {
        if ($this->cashPayment($order) && $this->projectType($order)) {
            $order = $this->makeProjectFinances($order);
        }

        return $order;
    }

    /**
     * @param $order
     * @return bool
     */
    protected function cashPayment($order)
    {
        return Order::GATEWAY_CASH == $order->gateway;
    }

    /**
     * @param $order
     * @return bool
     */
    protected function projectType($order)
    {
        return ($history = $order->userHistory) && 'project' == $history->workout;
    }

    /**
     * @param $order
     * @return mixed
     */
    protected function makeProjectFinances($order)
    {
        return $order->fill([
            'details'  => [
                'discount' => $order->discount,
                'amount'   => $order->amount
            ],
            'discount' => 100,
            'amount'   => 0
        ]);
    }
}
