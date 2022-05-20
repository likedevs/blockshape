<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReferenceProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reference_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->string('name', 200);
			$table->decimal('proteins', 3, 1)->default(0.0);
			$table->decimal('lipids', 3, 1)->default(0.0);
			$table->decimal('disaccharides', 3, 1)->default(0.0);
			$table->decimal('starch', 3, 1);
			$table->integer('energy_value')->unsigned();
			$table->unique(['group_id','name']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reference_products');
	}

}
