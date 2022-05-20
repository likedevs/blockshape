<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->nullable()->unique();
			$table->string('phone', 12)->nullable()->default('');
			$table->date('birth_date')->nullable();
			$table->string('image')->nullable()->default('');
			$table->string('password', 60);
			$table->enum('role', array('member','instructor','admin','manager'))->default('member')->index();
			$table->boolean('active')->default(1)->index();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
