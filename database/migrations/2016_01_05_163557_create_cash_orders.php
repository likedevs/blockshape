<?php

use App\Order;
use App\UserHistory;
use Illuminate\Database\Migrations\Migration;

class CreateCashOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        $notOrderedHistory = UserHistory::select('user_history.*')->leftJoin('orders', function ($join) {
//            $join->on('user_history.id', '=', 'orders.user_history_id');
//        })->whereNull('orders.id');


        //select * from user_history where id not in (select user_history_id from orders);
        $notOrderedHistory = UserHistory::whereNotIn('id', Order::get()->lists('user_history_id'));

        $files = $this->files();
        $orderCreator = $this->creator();
        $migrated = [];

        $notOrderedHistory->chunk(50, function($records) use ($files, $orderCreator, &$migrated) {
            foreach ($records as $record) {
                if (2 == $record->priority) {
                    $offer = 1;
                } else {
                    $offer = 2;
                }

                $orderCreator->create(
                    $record->user,
                    [
                        'history' => $record->id,
                        'offer'   => $offer,
                        'gateway' => Order::GATEWAY_CASH,
                        'status'  => Order::STATUS_PAID
                    ]
                );

                $migrated[] = $record->id;
            }
        });

        $files->put(
            $this->storage(),
            json_encode($migrated)
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $files = $this->files();

        $orders = json_decode($files->get($path = $this->storage()));

        Order::whereIn('user_history_id', $orders)->delete();

        $files->delete($path);
    }

    /**
     * @return \Illuminate\Filesystem\Filesystem
     */
    private function files()
    {
        $files = app('files');

        return $files;
    }

    /**
     * @return \App\Services\CreateOrder
     */
    private function creator()
    {
        $orderCreator = app()->make('App\Services\CreateOrder');

        return $orderCreator;
    }

    /**
     * @return string
     */
    private function storage()
    {
        return base_path('database/migrations/order_less_records.json');
    }
}
