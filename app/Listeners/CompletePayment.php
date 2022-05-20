<?php

namespace App\Listeners;

use App\Events\DocumentConfirmed;
use App\Repositories\OrdersRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use VbService;

class CompletePayment
{
    /**
     * @var OrdersRepository
     */
    private $orders;

    /**
     * Create the event listener.
     *
     * @param OrdersRepository $orders
     */
    public function __construct(OrdersRepository $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Handle the event.
     *
     * @param  DocumentConfirmed  $event
     * @return void
     */
    public function handle(DocumentConfirmed $event)
    {
        $record = $event->record;

        if ($order = $this->findOrder($record)) {
            if (is_array($order->details) && ! empty($order->details)) {
                VbService::confirm($order->details);
            }
        }
    }

    /**
     * @param $record
     * @return mixed
     */
    protected function findOrder($record)
    {
        return $this->orders->firstByOptions([
            'user_history_id' => (int) $record->id,
            'gateway'         => 'cc-vb',
            'status'          => 'pending'
        ]);
    }
}
