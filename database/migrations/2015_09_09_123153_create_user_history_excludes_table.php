<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHistoryExcludesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_history_excludes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('history_id')->unsigned()->index('user_history_excludes_history_id_foreign');
			$table->integer('exclude_id')->unsigned()->index('user_history_excludes_exclude_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_history_excludes');
	}

}
