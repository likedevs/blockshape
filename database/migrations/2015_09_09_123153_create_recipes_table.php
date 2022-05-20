<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecipesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recipes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('nutrient_id')->unsigned()->index('recipes_nutrient_id_foreign');
			$table->string('name', 100)->default('');
			$table->string('quantity', 30)->nullable();
			$table->boolean('snack')->default(0);
			$table->simple_array('season')->nullable();
			$table->simple_array('eating')->nullable();
			$table->enum('placement', array('before','after'))->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recipes');
	}

}
