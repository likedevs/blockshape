<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quiz_questions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('rank')->unsigned()->default(1);
			$table->string('question');
			$table->integer('answer_group_id')->unsigned()->nullable()->index('quiz_questions_answer_group_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quiz_questions');
	}

}
