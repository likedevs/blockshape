<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiseasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('diseases', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('rank')->unsigned()->default(1);
			$table->string('name', 60);
			$table->text('note', 65535)->nullable();
			$table->integer('parent_id')->unsigned()->nullable()->index('diseases_parent_id_foreign');
			$table->boolean('defer')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('diseases');
	}

}
