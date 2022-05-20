<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDocumentFieldTypeToBigtext extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_history', function (Blueprint $table) {
            DB::statement("ALTER TABLE user_history CHANGE `document` `document` LONGTEXT DEFAULT NULL;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_history', function (Blueprint $table) {
            DB::statement("ALTER TABLE user_history CHANGE `document` `document` VARCHAR(255) DEFAULT NULL;");
        });
    }
}
