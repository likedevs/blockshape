<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateVbTransactions extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vb_transactions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('client_email');
            $table->enum('status', ['SUCCESS', 'PENDING', 'DUPLICATED', 'DECLINED', 'FAULT']);
            $table->text('params');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('vb_transactions');
    }
}
