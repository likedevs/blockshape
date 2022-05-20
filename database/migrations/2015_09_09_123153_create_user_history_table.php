<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_history', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('user_id');
			$table->integer('office_id')->unsigned()->index('user_history_office_id_foreign');
			$table->integer('instructor_id')->unsigned()->index('user_history_instructor_id_foreign');
			$table->integer('target_id')->unsigned()->default(1)->index('user_history_target_id_foreign');
			$table->boolean('height');
			$table->decimal('current_weight', 4, 1);
			$table->decimal('target_weight', 4, 1);
			$table->enum('bone_radius', array('11','12','13','14','15','16','17','18','19'));
			$table->integer('figure_type_id')->unsigned()->index('figure_type_id');
			$table->decimal('talia1', 4, 1);
			$table->decimal('talia2', 4, 1);
			$table->decimal('talia3', 4, 1);
			$table->decimal('buttocks', 4, 1);
			$table->decimal('thigh1', 4, 1);
			$table->decimal('thigh2', 4, 1);
			$table->decimal('shoulders', 4, 1);
			$table->decimal('pulse1');
			$table->decimal('pulse2');
			$table->decimal('pulse3');
			$table->string('pressure_rest');
			$table->string('pressure_load');
			$table->integer('pressure_type_id')->unsigned()->nullable()->index('user_history_pressure_type_id_foreign');
			$table->string('menstrual_cycle');
			$table->text('other_diseases', 65535)->nullable();
			$table->text('other_allergies', 65535)->nullable();
			$table->text('other_excludes', 65535)->nullable();
			$table->text('schedule', 16777215);
			$table->timestamps();
			$table->date('purchased_at');
			$table->enum('status', array('pending','confirmed','declined'))->default('pending')->index();
			$table->string('document')->nullable();
			$table->text('declineReason', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_history');
	}

}
