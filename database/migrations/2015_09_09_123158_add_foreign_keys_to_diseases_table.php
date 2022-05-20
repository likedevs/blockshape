<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDiseasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('diseases', function(Blueprint $table)
		{
			$table->foreign('parent_id')->references('id')->on('diseases')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('diseases', function(Blueprint $table)
		{
			$table->dropForeign('diseases_parent_id_foreign');
		});
	}

}
