<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHistoryQuizAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_history_quiz_answers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('history_id')->unsigned();
			$table->integer('question_id')->unsigned()->index('user_history_quiz_answers_question_id_foreign');
			$table->integer('answer_id')->unsigned()->index('user_history_quiz_answers_answer_id_foreign');
			$table->unique(['history_id','question_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_history_quiz_answers');
	}

}
