<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHistoryQuizAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_history_quiz_answers', function(Blueprint $table)
		{
			$table->foreign('answer_id')->references('id')->on('quiz_answers')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('history_id')->references('id')->on('user_history')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('question_id')->references('id')->on('quiz_questions')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_history_quiz_answers', function(Blueprint $table)
		{
			$table->dropForeign('user_history_quiz_answers_answer_id_foreign');
			$table->dropForeign('user_history_quiz_answers_history_id_foreign');
			$table->dropForeign('user_history_quiz_answers_question_id_foreign');
		});
	}

}
