<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExercisePressureMapTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exercise_pressure_map', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('exercise_id')->unsigned()->unique();
			$table->boolean('p_110');
			$table->boolean('p_120');
			$table->boolean('p_130');
			$table->boolean('p_140');
			$table->boolean('p_150');
			$table->boolean('p_160');
			$table->boolean('p_170');
			$table->boolean('p_180');
			$table->boolean('p_190');
			$table->boolean('p_200');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exercise_pressure_map');
	}

}
