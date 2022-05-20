<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOfficeUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('office_user', function(Blueprint $table)
		{
			$table->foreign('user_id', 'office_user_ibfk_3')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('office_id', 'office_user_ibfk_2')->references('id')->on('offices')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('office_user', function(Blueprint $table)
		{
			$table->dropForeign('office_user_ibfk_3');
			$table->dropForeign('office_user_ibfk_2');
		});
	}

}
