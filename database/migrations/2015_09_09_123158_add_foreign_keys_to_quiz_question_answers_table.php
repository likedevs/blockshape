<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToQuizQuestionAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quiz_question_answers', function(Blueprint $table)
		{
			$table->foreign('answer_id')->references('id')->on('quiz_answers')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('hint_id')->references('id')->on('quiz_hints')->onUpdate('CASCADE')->onDelete('CASCADE');
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
		Schema::table('quiz_question_answers', function(Blueprint $table)
		{
			$table->dropForeign('quiz_question_answers_answer_id_foreign');
			$table->dropForeign('quiz_question_answers_hint_id_foreign');
			$table->dropForeign('quiz_question_answers_question_id_foreign');
		});
	}

}
