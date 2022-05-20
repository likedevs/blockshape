<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecipeFoodExcludesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recipe_food_excludes', function(Blueprint $table)
		{
			$table->foreign('food_excludes_id')->references('id')->on('food_excludes')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('recipe_food_excludes', function(Blueprint $table)
		{
			$table->dropForeign('recipe_food_excludes_food_excludes_id_foreign');
			$table->dropForeign('recipe_food_excludes_recipe_id_foreign');
		});
	}

}
