<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfficeGatewayToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `orders` CHANGE `gateway` `gateway` enum ('qiwi','cc-vb','cash') NOT NULL DEFAULT 'cash'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `orders` CHANGE `gateway` `gateway` enum ('qiwi','cc-vb')");
    }
}
