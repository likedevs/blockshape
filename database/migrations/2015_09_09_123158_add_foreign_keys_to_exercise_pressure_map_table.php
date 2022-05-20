<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToExercisePressureMapTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exercise_pressure_map', function(Blueprint $table)
		{
			$table->foreign('exercise_id')->references('id')->on('exercises')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('exercise_pressure_map', function(Blueprint $table)
		{
			$table->dropForeign('exercise_pressure_map_exercise_id_foreign');
		});
	}

}
