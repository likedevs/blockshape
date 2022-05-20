<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToReferenceProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reference_products', function(Blueprint $table)
		{
			$table->foreign('group_id')->references('id')->on('reference_groups')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reference_products', function(Blueprint $table)
		{
			$table->dropForeign('reference_products_group_id_foreign');
		});
	}

}
