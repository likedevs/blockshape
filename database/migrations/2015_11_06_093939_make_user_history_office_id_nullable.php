<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUserHistoryOfficeIdNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE user_history CHANGE `office_id` `office_id` INTEGER (10) UNSIGNED DEFAULT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE user_history CHANGE `office_id` `office_id` INTEGER (10) UNSIGNED NOT NULL;");
    }
}
