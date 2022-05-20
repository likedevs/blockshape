<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecipeDiseasesExcludesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recipe_diseases_excludes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('recipe_id')->unsigned()->index('recipe_diseases_excludes_recipe_id_foreign');
			$table->integer('disease_id')->unsigned()->index('recipe_diseases_excludes_disease_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recipe_diseases_excludes');
	}

}
