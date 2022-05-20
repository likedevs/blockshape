<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToReferenceGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reference_groups', function(Blueprint $table)
		{
			$table->foreign('nutrient_id', 'reference_groups_ibfk_1')->references('id')->on('nutrients')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reference_groups', function(Blueprint $table)
		{
			$table->dropForeign('reference_groups_ibfk_1');
		});
	}

}
