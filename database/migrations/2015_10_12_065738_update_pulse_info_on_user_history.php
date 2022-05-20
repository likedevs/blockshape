<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePulseInfoOnUserHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_history', function (Blueprint $table) {
            $table->dropColumn(['pulse1', 'pulse2']);
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
            $table->unsignedInteger('pulse1')->after('shoulders');
            $table->unsignedInteger('pulse2')->after('pulse1');
        });
    }
}
