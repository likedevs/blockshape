<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_history', function(Blueprint $table)
		{
			$table->foreign('user_id', 'user_history_ibfk_2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('figure_type_id', 'user_history_ibfk_1')->references('id')->on('figure_types')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('instructor_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('office_id')->references('id')->on('offices')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('pressure_type_id')->references('id')->on('pressure_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('target_id')->references('id')->on('targets')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_history', function(Blueprint $table)
		{
			$table->dropForeign('user_history_ibfk_2');
			$table->dropForeign('user_history_ibfk_1');
			$table->dropForeign('user_history_instructor_id_foreign');
			$table->dropForeign('user_history_office_id_foreign');
			$table->dropForeign('user_history_pressure_type_id_foreign');
			$table->dropForeign('user_history_target_id_foreign');
		});
	}

}
