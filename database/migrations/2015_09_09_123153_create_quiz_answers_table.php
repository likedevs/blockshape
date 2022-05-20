<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quiz_answers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('answer', 100);
			$table->integer('group_id')->unsigned();
			$table->boolean('rank')->default(1);
			$table->unique(['group_id','answer']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quiz_answers');
	}

}
