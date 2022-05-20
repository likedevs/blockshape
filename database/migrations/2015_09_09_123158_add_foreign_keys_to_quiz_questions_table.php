<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToQuizQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quiz_questions', function(Blueprint $table)
		{
			$table->foreign('answer_group_id')->references('id')->on('quiz_answers_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quiz_questions', function(Blueprint $table)
		{
			$table->dropForeign('quiz_questions_answer_group_id_foreign');
		});
	}

}
