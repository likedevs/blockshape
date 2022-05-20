<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHistoryExcludesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_history_excludes', function(Blueprint $table)
		{
			$table->foreign('exclude_id')->references('id')->on('food_excludes')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('user_history_excludes', function(Blueprint $table)
		{
			$table->dropForeign('user_history_excludes_exclude_id_foreign');
			$table->dropForeign('user_history_excludes_history_id_foreign');
		});
	}

}
