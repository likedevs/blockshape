<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePulseNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE user_history CHANGE `pulse3` `pulse3` TINYINT(1) UNSIGNED DEFAULT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE user_history CHANGE `pulse3` `pulse3` TINYINT(1) UNSIGNED NOT NULL;");
    }
}
