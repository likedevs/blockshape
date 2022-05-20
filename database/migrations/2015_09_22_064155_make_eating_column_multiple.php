<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeEatingColumnMultiple extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            DB::statement("ALTER TABLE recipes CHANGE `eating_gain` `eating_gain` SET('1','2','3','4','5') DEFAULT NULL;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            DB::statement("ALTER TABLE recipes CHANGE `eating_gain` `eating_gain` ENUM('1','2','3','4','5') DEFAULT NULL;");
        });
    }
}
