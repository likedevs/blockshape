<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizQuestionAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quiz_question_answers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('question_id')->unsigned()->index('quiz_question_answers_question_id_foreign');
			$table->integer('answer_id')->unsigned()->index('quiz_question_answers_answer_id_foreign');
			$table->integer('hint_id')->unsigned()->index('quiz_question_answers_hint_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quiz_question_answers');
	}

}
