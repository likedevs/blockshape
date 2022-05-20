<?php

use Illuminate\Database\Seeder;

class ReferenceGroupsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('reference_groups')->delete();
        
		\DB::table('reference_groups')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'Carne',
				'nutrient_id' => 1,
			),
			1 => 
			array (
				'id' => 2,
				'name' => 'Pește',
				'nutrient_id' => 1,
			),
			2 => 
			array (
				'id' => 3,
				'name' => 'Produse lactate',
				'nutrient_id' => 1,
			),
			3 => 
			array (
				'id' => 4,
				'name' => 'Brinzeturi',
				'nutrient_id' => 1,
			),
			4 => 
			array (
				'id' => 5,
				'name' => 'Crupe',
				'nutrient_id' => 2,
			),
			5 => 
			array (
				'id' => 6,
				'name' => 'Cultura de pepenarie',
				'nutrient_id' => 2,
			),
			6 => 
			array (
				'id' => 7,
				'name' => 'Legume',
				'nutrient_id' => 2,
			),
			7 => 
			array (
				'id' => 8,
				'name' => 'Fructe',
				'nutrient_id' => 2,
			),
			8 => 
			array (
				'id' => 9,
				'name' => 'Fructe uscate',
				'nutrient_id' => 2,
			),
			9 => 
			array (
				'id' => 10,
				'name' => 'Seminte si fructe oleaginoase',
				'nutrient_id' => 2,
			),
			10 => 
			array (
				'id' => 11,
				'name' => 'Ulei vegetl',
				'nutrient_id' => 4,
			),
		));
	}

}
