<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTargetsToSetType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            DB::statement("ALTER TABLE recipes CHANGE `targets` `targets` SET('weight-loss', 'weight-gain', 'maintenance');");
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
            DB::statement("ALTER TABLE recipes CHANGE `targets` `targets` ENUM('weight-loss', 'weight-gain', 'maintenance');");
        });
    }
}
