<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHistoryDiseasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_history_diseases', function(Blueprint $table)
		{
			$table->foreign('disease_id')->references('id')->on('diseases')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('user_history_diseases', function(Blueprint $table)
		{
			$table->dropForeign('user_history_diseases_disease_id_foreign');
			$table->dropForeign('user_history_diseases_history_id_foreign');
		});
	}

}
