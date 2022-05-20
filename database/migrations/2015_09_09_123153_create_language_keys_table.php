<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguageKeysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('language_keys', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('status')->default(0);
			$table->string('group');
			$table->string('key');
			$table->unique(['group','key'], 'group');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('language_keys');
	}

}
