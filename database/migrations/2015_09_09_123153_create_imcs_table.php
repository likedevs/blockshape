<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImcsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imcs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->decimal('value_min', 3, 1);
			$table->decimal('value_max', 3, 1);
			$table->text('note', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imcs');
	}

}
