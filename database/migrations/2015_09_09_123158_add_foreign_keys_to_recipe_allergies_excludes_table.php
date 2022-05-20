<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecipeAllergiesExcludesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recipe_allergies_excludes', function(Blueprint $table)
		{
			$table->foreign('allergy_id')->references('id')->on('allergies')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('recipe_allergies_excludes', function(Blueprint $table)
		{
			$table->dropForeign('recipe_allergies_excludes_allergy_id_foreign');
			$table->dropForeign('recipe_allergies_excludes_recipe_id_foreign');
		});
	}

}
