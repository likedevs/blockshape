<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToQuizAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quiz_answers', function(Blueprint $table)
		{
			$table->foreign('group_id')->references('id')->on('quiz_answers_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quiz_answers', function(Blueprint $table)
		{
			$table->dropForeign('quiz_answers_group_id_foreign');
		});
	}

}
