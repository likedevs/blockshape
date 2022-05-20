<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConstitutionTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('constitution_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->text('note', 65535);
			$table->boolean('bone_min')->index();
			$table->boolean('bone_max')->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('constitution_types');
	}

}
