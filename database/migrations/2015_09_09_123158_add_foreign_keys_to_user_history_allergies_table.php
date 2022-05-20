<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHistoryAllergiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_history_allergies', function(Blueprint $table)
		{
			$table->foreign('allergy_id')->references('id')->on('allergies')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('history_id')->references('id')->on('user_history')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_history_allergies', function(Blueprint $table)
		{
			$table->dropForeign('user_history_allergies_allergy_id_foreign');
			$table->dropForeign('user_history_allergies_history_id_foreign');
		});
	}

}
