<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecipeDiseasesExcludesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recipe_diseases_excludes', function(Blueprint $table)
		{
			$table->foreign('disease_id')->references('id')->on('diseases')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('recipe_id')->references('id')->on('recipes')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('recipe_diseases_excludes', function(Blueprint $table)
		{
			$table->dropForeign('recipe_diseases_excludes_disease_id_foreign');
			$table->dropForeign('recipe_diseases_excludes_recipe_id_foreign');
		});
	}

}
