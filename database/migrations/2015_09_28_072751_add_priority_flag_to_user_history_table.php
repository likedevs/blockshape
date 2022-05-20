<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriorityFlagToUserHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_history', function (Blueprint $table) {
            $table->tinyInteger('priority', false, true)->after('workout')->default(14);

            $table->index('priority');
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
            $table->dropColumn('priority');
        });
    }
}
