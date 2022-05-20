<?php

namespace App\Repositories;

use App\Order;

class OrdersRepository extends Repository
{
    /**
     * Find an order by id
     *
     * @param $key
     * @return mixed
     */
    public function find($key)
    {
        return $this->createModel()->find($key);
    }

    /**
     * Find an order by global order id
     *
     * @param $orderID
     * @return mixed
     */
    public function findByOrderId($orderID)
    {
        return $this->createModel()->where('order_id', $orderID)->first();
    }

    /**
     * Find an order by more then one criteria
     *
     * @param array $options
     * @return $options
     */
    public function firstByOptions(array $options = [])
    {
        $query = $this->createModel()->select();
        
        foreach ($options as $column => $option) {
            if (is_array($option)) {
                $query->whereIn($column, $option);
            } else {
                $query->where($column, $option);
            }
        }

        $query->orderBy('id', 'desc');

        return $query->first();
    }

    public function buildOrderId()
    {
        $order = $this->createModel()->whereNotNull('order_id')->orderBy('order_id', 'desc')->first();

        return ($order ? $order->order_id + 1 : 10000000);
    }

    /**
     * Create a new order
     *
     * @param array $data
     * @return static
     */
    public function create(array $data = [])
    {
        return $this->createModel()->create($data);
    }

    /**
     * Update order info
     *
     * @param Order $order
     * @param array $data
     * @return Order
     */
    public function save(Order $order, array $data = [])
    {

        $order
            ->fill($data)
            ->save();

        return $order;
    }

    /**
     * Cancel order
     * @param Order $order
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        return $order->delete();
    }
}