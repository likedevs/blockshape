<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->index('name');
            $table->index('snack');
            $table->index('season');
            $table->index('eating');
            $table->index('placement');
            $table->index('targets');
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
            $table->dropIndex(['name', 'snack', 'season', 'eating', 'placement', 'targets']);
        });
    }
}
