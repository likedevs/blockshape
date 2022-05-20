<?php

use App\Order;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_history_id');
            $table->unsignedInteger('offer_id');
            $table->enum('gateway', [Order::GATEWAY_QIWI, Order::GATEWAY_VB]);
            $table->text('details')->nullable();
            $table->unsignedTinyInteger('period');
            $table->decimal('amount')->unsigned();
            $table->enum('status', [Order::STATUS_PENDING, Order::STATUS_PAID, Order::STATUS_DECLINED]);
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_history_id', 'orders_user_history_id_foreign')->references('id')->on('user_history')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('offer_id', 'orders_offer_id_foreign')->references('id')->on('offers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_user_history_id_foreign');
            $table->dropForeign('orders_offer_id_foreign');
        });

        Schema::drop('orders');
    }
}
