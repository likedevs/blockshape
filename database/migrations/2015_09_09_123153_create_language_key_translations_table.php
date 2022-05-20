<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguageKeyTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('language_key_translations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('translation_id')->unsigned()->index('language_key_translations_translation_id_foreign');
			$table->integer('language_id')->unsigned()->index('language_key_translations_language_id_foreign');
			$table->text('value', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('language_key_translations');
	}

}
