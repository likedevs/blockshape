<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUserHistoryPressureRestNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE user_history CHANGE `pressure_rest` `pressure_rest` VARCHAR (255) DEFAULT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE user_history CHANGE `pressure_rest` `pressure_rest` VARCHAR (255) NOT NULL;");
    }
}
