<?php

use Illuminate\Database\Seeder;

class ReferenceProductsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('reference_products')->delete();
        
		\DB::table('reference_products')->insert(array (
			0 => 
			array (
				'id' => 128,
				'group_id' => 1,
				'name' => 'Animi vel itaque.',
				'proteins' => '0.8',
				'lipids' => '0.0',
				'disaccharides' => '0.4',
				'starch' => '1.0',
				'energy_value' => 188,
			),
			1 => 
			array (
				'id' => 129,
				'group_id' => 1,
				'name' => 'Nulla dolorum fugiat.',
				'proteins' => '0.2',
				'lipids' => '0.7',
				'disaccharides' => '0.6',
				'starch' => '0.6',
				'energy_value' => 369,
			),
			2 => 
			array (
				'id' => 130,
				'group_id' => 1,
				'name' => 'Sed libero iusto.',
				'proteins' => '0.9',
				'lipids' => '0.3',
				'disaccharides' => '0.9',
				'starch' => '0.2',
				'energy_value' => 137,
			),
			3 => 
			array (
				'id' => 131,
				'group_id' => 1,
				'name' => 'Eius.',
				'proteins' => '0.3',
				'lipids' => '0.9',
				'disaccharides' => '0.6',
				'starch' => '0.7',
				'energy_value' => 301,
			),
			4 => 
			array (
				'id' => 132,
				'group_id' => 1,
				'name' => 'Quis et commodi.',
				'proteins' => '0.2',
				'lipids' => '0.6',
				'disaccharides' => '0.9',
				'starch' => '0.1',
				'energy_value' => 34,
			),
			5 => 
			array (
				'id' => 133,
				'group_id' => 1,
				'name' => 'Et.',
				'proteins' => '0.9',
				'lipids' => '0.1',
				'disaccharides' => '1.0',
				'starch' => '1.0',
				'energy_value' => 382,
			),
			6 => 
			array (
				'id' => 134,
				'group_id' => 1,
				'name' => 'Explicabo itaque.',
				'proteins' => '0.8',
				'lipids' => '1.0',
				'disaccharides' => '0.5',
				'starch' => '0.7',
				'energy_value' => 65,
			),
			7 => 
			array (
				'id' => 135,
				'group_id' => 1,
				'name' => 'Ut consequatur.',
				'proteins' => '0.1',
				'lipids' => '0.1',
				'disaccharides' => '1.0',
				'starch' => '0.6',
				'energy_value' => 297,
			),
			8 => 
			array (
				'id' => 136,
				'group_id' => 1,
				'name' => 'Debitis.',
				'proteins' => '0.4',
				'lipids' => '0.3',
				'disaccharides' => '0.9',
				'starch' => '0.1',
				'energy_value' => 84,
			),
			9 => 
			array (
				'id' => 137,
				'group_id' => 1,
				'name' => 'A et.',
				'proteins' => '1.0',
				'lipids' => '0.3',
				'disaccharides' => '0.8',
				'starch' => '0.7',
				'energy_value' => 276,
			),
			10 => 
			array (
				'id' => 138,
				'group_id' => 1,
				'name' => 'Tempore quia.',
				'proteins' => '0.0',
				'lipids' => '0.6',
				'disaccharides' => '0.2',
				'starch' => '0.4',
				'energy_value' => 139,
			),
			11 => 
			array (
				'id' => 139,
				'group_id' => 1,
				'name' => 'Animi sed.',
				'proteins' => '0.2',
				'lipids' => '0.7',
				'disaccharides' => '0.5',
				'starch' => '0.3',
				'energy_value' => 278,
			),
			12 => 
			array (
				'id' => 140,
				'group_id' => 1,
				'name' => 'Non fugiat.',
				'proteins' => '0.9',
				'lipids' => '0.6',
				'disaccharides' => '0.7',
				'starch' => '0.8',
				'energy_value' => 138,
			),
			13 => 
			array (
				'id' => 141,
				'group_id' => 1,
				'name' => 'Id iusto.',
				'proteins' => '0.4',
				'lipids' => '0.5',
				'disaccharides' => '0.8',
				'starch' => '0.8',
				'energy_value' => 177,
			),
			14 => 
			array (
				'id' => 142,
				'group_id' => 1,
				'name' => 'Voluptas officia.',
				'proteins' => '0.8',
				'lipids' => '0.4',
				'disaccharides' => '1.0',
				'starch' => '0.7',
				'energy_value' => 95,
			),
			15 => 
			array (
				'id' => 143,
				'group_id' => 1,
				'name' => 'Voluptatem.',
				'proteins' => '0.9',
				'lipids' => '0.5',
				'disaccharides' => '0.2',
				'starch' => '0.4',
				'energy_value' => 310,
			),
			16 => 
			array (
				'id' => 144,
				'group_id' => 1,
				'name' => 'Tempore earum ipsum.',
				'proteins' => '0.8',
				'lipids' => '0.0',
				'disaccharides' => '0.1',
				'starch' => '0.4',
				'energy_value' => 173,
			),
			17 => 
			array (
				'id' => 145,
				'group_id' => 1,
				'name' => 'Sunt laudantium.',
				'proteins' => '0.8',
				'lipids' => '0.2',
				'disaccharides' => '0.1',
				'starch' => '0.5',
				'energy_value' => 362,
			),
			18 => 
			array (
				'id' => 146,
				'group_id' => 1,
				'name' => 'Ut.',
				'proteins' => '0.3',
				'lipids' => '0.4',
				'disaccharides' => '0.8',
				'starch' => '0.1',
				'energy_value' => 40,
			),
			19 => 
			array (
				'id' => 147,
				'group_id' => 1,
				'name' => 'Numquam sunt.',
				'proteins' => '0.4',
				'lipids' => '0.7',
				'disaccharides' => '0.6',
				'starch' => '0.4',
				'energy_value' => 309,
			),
			20 => 
			array (
				'id' => 148,
				'group_id' => 1,
				'name' => 'Doloribus repudiandae perferendis.',
				'proteins' => '0.0',
				'lipids' => '0.5',
				'disaccharides' => '0.3',
				'starch' => '0.0',
				'energy_value' => 350,
			),
			21 => 
			array (
				'id' => 149,
				'group_id' => 1,
				'name' => 'Qui.',
				'proteins' => '0.8',
				'lipids' => '0.5',
				'disaccharides' => '0.1',
				'starch' => '0.1',
				'energy_value' => 248,
			),
			22 => 
			array (
				'id' => 151,
				'group_id' => 2,
				'name' => 'Blanditiis et.',
				'proteins' => '0.8',
				'lipids' => '0.0',
				'disaccharides' => '0.8',
				'starch' => '1.0',
				'energy_value' => 53,
			),
			23 => 
			array (
				'id' => 152,
				'group_id' => 2,
				'name' => 'Voluptatum aperiam.',
				'proteins' => '0.5',
				'lipids' => '0.9',
				'disaccharides' => '0.9',
				'starch' => '1.0',
				'energy_value' => 345,
			),
			24 => 
			array (
				'id' => 153,
				'group_id' => 2,
				'name' => 'Tempora.',
				'proteins' => '0.2',
				'lipids' => '0.3',
				'disaccharides' => '0.1',
				'starch' => '0.5',
				'energy_value' => 87,
			),
			25 => 
			array (
				'id' => 154,
				'group_id' => 2,
				'name' => 'Vel.',
				'proteins' => '0.2',
				'lipids' => '0.9',
				'disaccharides' => '0.2',
				'starch' => '0.5',
				'energy_value' => 390,
			),
			26 => 
			array (
				'id' => 155,
				'group_id' => 2,
				'name' => 'Et porro.',
				'proteins' => '0.3',
				'lipids' => '0.1',
				'disaccharides' => '0.6',
				'starch' => '0.0',
				'energy_value' => 365,
			),
			27 => 
			array (
				'id' => 156,
				'group_id' => 2,
				'name' => 'Neque libero.',
				'proteins' => '0.3',
				'lipids' => '0.6',
				'disaccharides' => '0.8',
				'starch' => '0.5',
				'energy_value' => 225,
			),
			28 => 
			array (
				'id' => 157,
				'group_id' => 2,
				'name' => 'Modi.',
				'proteins' => '0.8',
				'lipids' => '0.4',
				'disaccharides' => '0.4',
				'starch' => '0.5',
				'energy_value' => 214,
			),
			29 => 
			array (
				'id' => 158,
				'group_id' => 2,
				'name' => 'Et ipsam quisquam.',
				'proteins' => '0.0',
				'lipids' => '0.4',
				'disaccharides' => '0.2',
				'starch' => '0.9',
				'energy_value' => 69,
			),
			30 => 
			array (
				'id' => 159,
				'group_id' => 2,
				'name' => 'Non illum aut.',
				'proteins' => '0.5',
				'lipids' => '0.8',
				'disaccharides' => '0.0',
				'starch' => '0.0',
				'energy_value' => 278,
			),
			31 => 
			array (
				'id' => 160,
				'group_id' => 2,
				'name' => 'Unde ad.',
				'proteins' => '0.6',
				'lipids' => '0.7',
				'disaccharides' => '0.9',
				'starch' => '0.4',
				'energy_value' => 218,
			),
			32 => 
			array (
				'id' => 161,
				'group_id' => 2,
				'name' => 'Quia.',
				'proteins' => '0.3',
				'lipids' => '0.3',
				'disaccharides' => '0.2',
				'starch' => '0.7',
				'energy_value' => 132,
			),
			33 => 
			array (
				'id' => 162,
				'group_id' => 2,
				'name' => 'Eum et nihil.',
				'proteins' => '0.3',
				'lipids' => '0.3',
				'disaccharides' => '0.8',
				'starch' => '0.2',
				'energy_value' => 342,
			),
			34 => 
			array (
				'id' => 163,
				'group_id' => 2,
				'name' => 'Aut expedita.',
				'proteins' => '0.8',
				'lipids' => '0.7',
				'disaccharides' => '0.5',
				'starch' => '0.5',
				'energy_value' => 333,
			),
			35 => 
			array (
				'id' => 164,
				'group_id' => 2,
				'name' => 'Officia temporibus labore.',
				'proteins' => '0.4',
				'lipids' => '0.4',
				'disaccharides' => '0.1',
				'starch' => '0.4',
				'energy_value' => 194,
			),
			36 => 
			array (
				'id' => 165,
				'group_id' => 2,
				'name' => 'Voluptas.',
				'proteins' => '0.7',
				'lipids' => '0.1',
				'disaccharides' => '0.8',
				'starch' => '0.8',
				'energy_value' => 160,
			),
			37 => 
			array (
				'id' => 166,
				'group_id' => 2,
				'name' => 'Consequuntur et reprehenderit.',
				'proteins' => '0.8',
				'lipids' => '0.8',
				'disaccharides' => '0.1',
				'starch' => '0.4',
				'energy_value' => 377,
			),
			38 => 
			array (
				'id' => 167,
				'group_id' => 2,
				'name' => 'Velit.',
				'proteins' => '0.6',
				'lipids' => '0.4',
				'disaccharides' => '0.6',
				'starch' => '0.1',
				'energy_value' => 399,
			),
			39 => 
			array (
				'id' => 168,
				'group_id' => 2,
				'name' => 'Vitae.',
				'proteins' => '0.2',
				'lipids' => '0.5',
				'disaccharides' => '0.1',
				'starch' => '0.9',
				'energy_value' => 263,
			),
			40 => 
			array (
				'id' => 169,
				'group_id' => 2,
				'name' => 'Quisquam.',
				'proteins' => '0.7',
				'lipids' => '0.7',
				'disaccharides' => '0.3',
				'starch' => '0.4',
				'energy_value' => 163,
			),
			41 => 
			array (
				'id' => 170,
				'group_id' => 2,
				'name' => 'Eaque animi.',
				'proteins' => '0.6',
				'lipids' => '0.2',
				'disaccharides' => '0.4',
				'starch' => '1.0',
				'energy_value' => 67,
			),
			42 => 
			array (
				'id' => 171,
				'group_id' => 3,
				'name' => 'Deserunt est.',
				'proteins' => '0.9',
				'lipids' => '0.7',
				'disaccharides' => '0.9',
				'starch' => '0.2',
				'energy_value' => 297,
			),
			43 => 
			array (
				'id' => 172,
				'group_id' => 3,
				'name' => 'Accusamus aut.',
				'proteins' => '0.7',
				'lipids' => '0.8',
				'disaccharides' => '0.9',
				'starch' => '0.1',
				'energy_value' => 389,
			),
			44 => 
			array (
				'id' => 173,
				'group_id' => 3,
				'name' => 'Voluptas sunt.',
				'proteins' => '0.8',
				'lipids' => '0.9',
				'disaccharides' => '0.3',
				'starch' => '0.7',
				'energy_value' => 299,
			),
			45 => 
			array (
				'id' => 174,
				'group_id' => 3,
				'name' => 'Eos.',
				'proteins' => '0.2',
				'lipids' => '0.6',
				'disaccharides' => '0.5',
				'starch' => '0.3',
				'energy_value' => 293,
			),
			46 => 
			array (
				'id' => 175,
				'group_id' => 3,
				'name' => 'Sed.',
				'proteins' => '0.5',
				'lipids' => '0.8',
				'disaccharides' => '0.7',
				'starch' => '0.3',
				'energy_value' => 212,
			),
			47 => 
			array (
				'id' => 176,
				'group_id' => 3,
				'name' => 'Et ut.',
				'proteins' => '0.9',
				'lipids' => '0.4',
				'disaccharides' => '0.5',
				'starch' => '0.3',
				'energy_value' => 31,
			),
			48 => 
			array (
				'id' => 177,
				'group_id' => 3,
				'name' => 'Occaecati vel.',
				'proteins' => '0.8',
				'lipids' => '0.8',
				'disaccharides' => '0.1',
				'starch' => '0.6',
				'energy_value' => 329,
			),
			49 => 
			array (
				'id' => 178,
				'group_id' => 3,
				'name' => 'Voluptatem ipsa.',
				'proteins' => '0.2',
				'lipids' => '0.6',
				'disaccharides' => '0.2',
				'starch' => '0.4',
				'energy_value' => 296,
			),
			50 => 
			array (
				'id' => 179,
				'group_id' => 3,
				'name' => 'Accusamus aliquid.',
				'proteins' => '0.5',
				'lipids' => '0.2',
				'disaccharides' => '0.7',
				'starch' => '0.6',
				'energy_value' => 119,
			),
			51 => 
			array (
				'id' => 180,
				'group_id' => 3,
				'name' => 'Ratione sint voluptas.',
				'proteins' => '0.3',
				'lipids' => '0.3',
				'disaccharides' => '1.0',
				'starch' => '0.5',
				'energy_value' => 254,
			),
			52 => 
			array (
				'id' => 181,
				'group_id' => 3,
				'name' => 'Deserunt sit.',
				'proteins' => '0.5',
				'lipids' => '0.2',
				'disaccharides' => '1.0',
				'starch' => '0.1',
				'energy_value' => 342,
			),
			53 => 
			array (
				'id' => 182,
				'group_id' => 3,
				'name' => 'Animi molestiae.',
				'proteins' => '0.7',
				'lipids' => '0.0',
				'disaccharides' => '0.9',
				'starch' => '0.3',
				'energy_value' => 164,
			),
			54 => 
			array (
				'id' => 183,
				'group_id' => 3,
				'name' => 'Eligendi consequatur facilis.',
				'proteins' => '0.2',
				'lipids' => '0.5',
				'disaccharides' => '0.6',
				'starch' => '0.6',
				'energy_value' => 60,
			),
			55 => 
			array (
				'id' => 184,
				'group_id' => 3,
				'name' => 'Adipisci nihil.',
				'proteins' => '0.8',
				'lipids' => '0.5',
				'disaccharides' => '0.4',
				'starch' => '0.2',
				'energy_value' => 296,
			),
			56 => 
			array (
				'id' => 185,
				'group_id' => 3,
				'name' => 'Maiores illo.',
				'proteins' => '0.8',
				'lipids' => '0.9',
				'disaccharides' => '1.0',
				'starch' => '0.6',
				'energy_value' => 325,
			),
			57 => 
			array (
				'id' => 186,
				'group_id' => 3,
				'name' => 'Sit aut.',
				'proteins' => '0.2',
				'lipids' => '0.1',
				'disaccharides' => '0.2',
				'starch' => '0.4',
				'energy_value' => 274,
			),
			58 => 
			array (
				'id' => 187,
				'group_id' => 3,
				'name' => 'Impedit fuga.',
				'proteins' => '0.2',
				'lipids' => '1.0',
				'disaccharides' => '0.7',
				'starch' => '0.4',
				'energy_value' => 391,
			),
			59 => 
			array (
				'id' => 188,
				'group_id' => 3,
				'name' => 'Consequatur.',
				'proteins' => '0.2',
				'lipids' => '0.9',
				'disaccharides' => '0.5',
				'starch' => '0.7',
				'energy_value' => 383,
			),
			60 => 
			array (
				'id' => 189,
				'group_id' => 3,
				'name' => 'Tempora distinctio optio.',
				'proteins' => '0.3',
				'lipids' => '0.9',
				'disaccharides' => '0.6',
				'starch' => '0.4',
				'energy_value' => 236,
			),
			61 => 
			array (
				'id' => 190,
				'group_id' => 3,
				'name' => 'Est vitae.',
				'proteins' => '0.6',
				'lipids' => '0.7',
				'disaccharides' => '0.5',
				'starch' => '1.0',
				'energy_value' => 66,
			),
			62 => 
			array (
				'id' => 191,
				'group_id' => 3,
				'name' => 'Illum molestias quod.',
				'proteins' => '0.7',
				'lipids' => '0.2',
				'disaccharides' => '0.5',
				'starch' => '0.5',
				'energy_value' => 51,
			),
			63 => 
			array (
				'id' => 192,
				'group_id' => 4,
				'name' => 'Maxime numquam.',
				'proteins' => '0.6',
				'lipids' => '0.5',
				'disaccharides' => '0.5',
				'starch' => '0.3',
				'energy_value' => 275,
			),
			64 => 
			array (
				'id' => 193,
				'group_id' => 4,
				'name' => 'Impedit.',
				'proteins' => '0.6',
				'lipids' => '0.6',
				'disaccharides' => '0.4',
				'starch' => '0.2',
				'energy_value' => 349,
			),
			65 => 
			array (
				'id' => 194,
				'group_id' => 4,
				'name' => 'Ut officia.',
				'proteins' => '0.2',
				'lipids' => '0.5',
				'disaccharides' => '0.2',
				'starch' => '1.0',
				'energy_value' => 33,
			),
			66 => 
			array (
				'id' => 195,
				'group_id' => 4,
				'name' => 'Ducimus eligendi.',
				'proteins' => '0.2',
				'lipids' => '0.5',
				'disaccharides' => '1.0',
				'starch' => '0.4',
				'energy_value' => 218,
			),
			67 => 
			array (
				'id' => 196,
				'group_id' => 4,
				'name' => 'Voluptate debitis.',
				'proteins' => '0.1',
				'lipids' => '0.6',
				'disaccharides' => '0.8',
				'starch' => '0.7',
				'energy_value' => 339,
			),
			68 => 
			array (
				'id' => 197,
				'group_id' => 4,
				'name' => 'Non sed ut.',
				'proteins' => '0.6',
				'lipids' => '0.7',
				'disaccharides' => '0.5',
				'starch' => '0.5',
				'energy_value' => 334,
			),
			69 => 
			array (
				'id' => 198,
				'group_id' => 4,
				'name' => 'Reprehenderit illum.',
				'proteins' => '0.6',
				'lipids' => '0.4',
				'disaccharides' => '0.7',
				'starch' => '0.4',
				'energy_value' => 217,
			),
			70 => 
			array (
				'id' => 199,
				'group_id' => 4,
				'name' => 'Ut minima.',
				'proteins' => '0.8',
				'lipids' => '0.3',
				'disaccharides' => '0.7',
				'starch' => '1.0',
				'energy_value' => 358,
			),
			71 => 
			array (
				'id' => 200,
				'group_id' => 4,
				'name' => 'Hic.',
				'proteins' => '0.9',
				'lipids' => '0.4',
				'disaccharides' => '0.8',
				'starch' => '0.6',
				'energy_value' => 105,
			),
			72 => 
			array (
				'id' => 201,
				'group_id' => 4,
				'name' => 'Maxime eligendi.',
				'proteins' => '0.6',
				'lipids' => '0.2',
				'disaccharides' => '0.6',
				'starch' => '0.2',
				'energy_value' => 199,
			),
			73 => 
			array (
				'id' => 202,
				'group_id' => 4,
				'name' => 'Neque explicabo.',
				'proteins' => '0.9',
				'lipids' => '0.7',
				'disaccharides' => '1.0',
				'starch' => '0.8',
				'energy_value' => 43,
			),
			74 => 
			array (
				'id' => 203,
				'group_id' => 4,
				'name' => 'Ut non.',
				'proteins' => '1.0',
				'lipids' => '1.0',
				'disaccharides' => '0.2',
				'starch' => '0.5',
				'energy_value' => 141,
			),
			75 => 
			array (
				'id' => 204,
				'group_id' => 4,
				'name' => 'Et accusamus.',
				'proteins' => '0.8',
				'lipids' => '0.3',
				'disaccharides' => '0.9',
				'starch' => '0.9',
				'energy_value' => 194,
			),
			76 => 
			array (
				'id' => 206,
				'group_id' => 5,
				'name' => 'Perspiciatis exercitationem voluptatum.',
				'proteins' => '0.4',
				'lipids' => '0.6',
				'disaccharides' => '0.3',
				'starch' => '0.5',
				'energy_value' => 273,
			),
			77 => 
			array (
				'id' => 207,
				'group_id' => 5,
				'name' => 'Voluptas eos.',
				'proteins' => '0.4',
				'lipids' => '0.7',
				'disaccharides' => '0.1',
				'starch' => '0.4',
				'energy_value' => 392,
			),
			78 => 
			array (
				'id' => 208,
				'group_id' => 5,
				'name' => 'Nisi nobis.',
				'proteins' => '0.7',
				'lipids' => '0.2',
				'disaccharides' => '0.5',
				'starch' => '0.4',
				'energy_value' => 281,
			),
			79 => 
			array (
				'id' => 209,
				'group_id' => 5,
				'name' => 'Repudiandae.',
				'proteins' => '0.7',
				'lipids' => '0.4',
				'disaccharides' => '0.1',
				'starch' => '0.2',
				'energy_value' => 167,
			),
			80 => 
			array (
				'id' => 210,
				'group_id' => 5,
				'name' => 'Architecto unde.',
				'proteins' => '0.4',
				'lipids' => '0.9',
				'disaccharides' => '0.5',
				'starch' => '0.8',
				'energy_value' => 324,
			),
			81 => 
			array (
				'id' => 211,
				'group_id' => 5,
				'name' => 'Natus.',
				'proteins' => '0.5',
				'lipids' => '0.5',
				'disaccharides' => '0.1',
				'starch' => '0.5',
				'energy_value' => 395,
			),
			82 => 
			array (
				'id' => 212,
				'group_id' => 5,
				'name' => 'Nihil nulla.',
				'proteins' => '0.5',
				'lipids' => '0.2',
				'disaccharides' => '0.4',
				'starch' => '0.8',
				'energy_value' => 329,
			),
			83 => 
			array (
				'id' => 213,
				'group_id' => 5,
				'name' => 'Et dolorem accusantium.',
				'proteins' => '0.8',
				'lipids' => '0.1',
				'disaccharides' => '1.0',
				'starch' => '0.3',
				'energy_value' => 381,
			),
			84 => 
			array (
				'id' => 214,
				'group_id' => 5,
				'name' => 'Dolore sunt sequi.',
				'proteins' => '0.8',
				'lipids' => '1.0',
				'disaccharides' => '0.5',
				'starch' => '0.6',
				'energy_value' => 165,
			),
			85 => 
			array (
				'id' => 215,
				'group_id' => 5,
				'name' => 'Dolores quam.',
				'proteins' => '0.1',
				'lipids' => '0.5',
				'disaccharides' => '0.7',
				'starch' => '1.0',
				'energy_value' => 52,
			),
			86 => 
			array (
				'id' => 216,
				'group_id' => 5,
				'name' => 'Ipsam voluptatem.',
				'proteins' => '0.9',
				'lipids' => '0.6',
				'disaccharides' => '0.2',
				'starch' => '0.1',
				'energy_value' => 229,
			),
			87 => 
			array (
				'id' => 217,
				'group_id' => 5,
				'name' => 'Molestiae distinctio.',
				'proteins' => '0.1',
				'lipids' => '0.5',
				'disaccharides' => '0.2',
				'starch' => '0.9',
				'energy_value' => 41,
			),
			88 => 
			array (
				'id' => 218,
				'group_id' => 5,
				'name' => 'Et non.',
				'proteins' => '0.8',
				'lipids' => '0.9',
				'disaccharides' => '0.5',
				'starch' => '0.4',
				'energy_value' => 257,
			),
			89 => 
			array (
				'id' => 219,
				'group_id' => 5,
				'name' => 'Est amet.',
				'proteins' => '0.6',
				'lipids' => '0.6',
				'disaccharides' => '0.9',
				'starch' => '0.9',
				'energy_value' => 167,
			),
			90 => 
			array (
				'id' => 220,
				'group_id' => 5,
				'name' => 'Et fuga laudantium.',
				'proteins' => '0.9',
				'lipids' => '0.8',
				'disaccharides' => '0.1',
				'starch' => '0.7',
				'energy_value' => 332,
			),
			91 => 
			array (
				'id' => 221,
				'group_id' => 5,
				'name' => 'Alias.',
				'proteins' => '0.4',
				'lipids' => '0.0',
				'disaccharides' => '0.6',
				'starch' => '0.5',
				'energy_value' => 362,
			),
			92 => 
			array (
				'id' => 222,
				'group_id' => 5,
				'name' => 'Aut vel.',
				'proteins' => '0.4',
				'lipids' => '0.5',
				'disaccharides' => '1.0',
				'starch' => '0.0',
				'energy_value' => 385,
			),
			93 => 
			array (
				'id' => 223,
				'group_id' => 5,
				'name' => 'Tempora harum.',
				'proteins' => '0.1',
				'lipids' => '0.8',
				'disaccharides' => '0.9',
				'starch' => '0.7',
				'energy_value' => 153,
			),
			94 => 
			array (
				'id' => 224,
				'group_id' => 6,
				'name' => 'Facere quidem.',
				'proteins' => '0.6',
				'lipids' => '0.4',
				'disaccharides' => '0.9',
				'starch' => '0.9',
				'energy_value' => 252,
			),
			95 => 
			array (
				'id' => 225,
				'group_id' => 6,
				'name' => 'Tenetur perspiciatis.',
				'proteins' => '0.6',
				'lipids' => '0.6',
				'disaccharides' => '0.4',
				'starch' => '0.8',
				'energy_value' => 143,
			),
			96 => 
			array (
				'id' => 226,
				'group_id' => 6,
				'name' => 'Rerum expedita est.',
				'proteins' => '0.8',
				'lipids' => '1.0',
				'disaccharides' => '0.6',
				'starch' => '0.2',
				'energy_value' => 283,
			),
			97 => 
			array (
				'id' => 227,
				'group_id' => 6,
				'name' => 'Aut officiis dicta.',
				'proteins' => '0.2',
				'lipids' => '0.9',
				'disaccharides' => '0.3',
				'starch' => '0.4',
				'energy_value' => 319,
			),
			98 => 
			array (
				'id' => 228,
				'group_id' => 6,
				'name' => 'Iusto at vel.',
				'proteins' => '0.1',
				'lipids' => '0.6',
				'disaccharides' => '0.5',
				'starch' => '0.2',
				'energy_value' => 42,
			),
			99 => 
			array (
				'id' => 229,
				'group_id' => 6,
				'name' => 'Velit vitae nihil.',
				'proteins' => '0.7',
				'lipids' => '0.0',
				'disaccharides' => '0.5',
				'starch' => '0.5',
				'energy_value' => 67,
			),
			100 => 
			array (
				'id' => 230,
				'group_id' => 6,
				'name' => 'Dolorem beatae.',
				'proteins' => '0.1',
				'lipids' => '0.4',
				'disaccharides' => '0.9',
				'starch' => '0.1',
				'energy_value' => 157,
			),
			101 => 
			array (
				'id' => 231,
				'group_id' => 6,
				'name' => 'Dolor et.',
				'proteins' => '0.4',
				'lipids' => '0.9',
				'disaccharides' => '0.5',
				'starch' => '1.0',
				'energy_value' => 156,
			),
			102 => 
			array (
				'id' => 232,
				'group_id' => 6,
				'name' => 'Pariatur officia sequi.',
				'proteins' => '0.3',
				'lipids' => '0.6',
				'disaccharides' => '0.4',
				'starch' => '0.2',
				'energy_value' => 299,
			),
			103 => 
			array (
				'id' => 233,
				'group_id' => 6,
				'name' => 'Culpa ut.',
				'proteins' => '0.6',
				'lipids' => '0.6',
				'disaccharides' => '0.4',
				'starch' => '0.3',
				'energy_value' => 171,
			),
			104 => 
			array (
				'id' => 234,
				'group_id' => 6,
				'name' => 'Sunt dolor aut.',
				'proteins' => '0.9',
				'lipids' => '0.7',
				'disaccharides' => '0.1',
				'starch' => '0.2',
				'energy_value' => 395,
			),
			105 => 
			array (
				'id' => 235,
				'group_id' => 6,
				'name' => 'Deleniti.',
				'proteins' => '0.5',
				'lipids' => '0.1',
				'disaccharides' => '0.3',
				'starch' => '0.6',
				'energy_value' => 373,
			),
			106 => 
			array (
				'id' => 236,
				'group_id' => 6,
				'name' => 'Autem earum nemo.',
				'proteins' => '0.2',
				'lipids' => '0.3',
				'disaccharides' => '1.0',
				'starch' => '0.7',
				'energy_value' => 37,
			),
			107 => 
			array (
				'id' => 237,
				'group_id' => 6,
				'name' => 'Laudantium.',
				'proteins' => '0.9',
				'lipids' => '0.9',
				'disaccharides' => '0.9',
				'starch' => '0.8',
				'energy_value' => 290,
			),
			108 => 
			array (
				'id' => 238,
				'group_id' => 6,
				'name' => 'Rerum molestiae omnis.',
				'proteins' => '0.6',
				'lipids' => '0.3',
				'disaccharides' => '0.2',
				'starch' => '0.4',
				'energy_value' => 367,
			),
			109 => 
			array (
				'id' => 239,
				'group_id' => 6,
				'name' => 'Omnis dolores.',
				'proteins' => '0.6',
				'lipids' => '0.0',
				'disaccharides' => '0.4',
				'starch' => '0.7',
				'energy_value' => 379,
			),
			110 => 
			array (
				'id' => 240,
				'group_id' => 6,
				'name' => 'Quasi sint.',
				'proteins' => '0.2',
				'lipids' => '0.7',
				'disaccharides' => '0.7',
				'starch' => '0.7',
				'energy_value' => 249,
			),
			111 => 
			array (
				'id' => 241,
				'group_id' => 6,
				'name' => 'Sunt facilis.',
				'proteins' => '0.3',
				'lipids' => '1.0',
				'disaccharides' => '0.2',
				'starch' => '0.7',
				'energy_value' => 120,
			),
			112 => 
			array (
				'id' => 242,
				'group_id' => 6,
				'name' => 'Et autem.',
				'proteins' => '0.6',
				'lipids' => '0.2',
				'disaccharides' => '0.0',
				'starch' => '0.2',
				'energy_value' => 356,
			),
			113 => 
			array (
				'id' => 243,
				'group_id' => 6,
				'name' => 'Esse sit.',
				'proteins' => '0.3',
				'lipids' => '0.4',
				'disaccharides' => '0.3',
				'starch' => '0.3',
				'energy_value' => 243,
			),
			114 => 
			array (
				'id' => 244,
				'group_id' => 6,
				'name' => 'Officiis mollitia amet.',
				'proteins' => '0.4',
				'lipids' => '0.9',
				'disaccharides' => '0.0',
				'starch' => '0.4',
				'energy_value' => 351,
			),
			115 => 
			array (
				'id' => 245,
				'group_id' => 7,
				'name' => 'Quisquam ea repellendus.',
				'proteins' => '0.6',
				'lipids' => '1.0',
				'disaccharides' => '0.7',
				'starch' => '0.9',
				'energy_value' => 223,
			),
			116 => 
			array (
				'id' => 246,
				'group_id' => 7,
				'name' => 'Et et.',
				'proteins' => '0.5',
				'lipids' => '0.8',
				'disaccharides' => '0.3',
				'starch' => '1.0',
				'energy_value' => 163,
			),
			117 => 
			array (
				'id' => 247,
				'group_id' => 7,
				'name' => 'Cupiditate nemo.',
				'proteins' => '0.5',
				'lipids' => '0.2',
				'disaccharides' => '0.3',
				'starch' => '0.2',
				'energy_value' => 87,
			),
			118 => 
			array (
				'id' => 248,
				'group_id' => 7,
				'name' => 'Quis et.',
				'proteins' => '0.6',
				'lipids' => '0.2',
				'disaccharides' => '0.9',
				'starch' => '0.4',
				'energy_value' => 190,
			),
			119 => 
			array (
				'id' => 249,
				'group_id' => 7,
				'name' => 'Eveniet earum debitis.',
				'proteins' => '0.7',
				'lipids' => '0.2',
				'disaccharides' => '0.4',
				'starch' => '0.4',
				'energy_value' => 211,
			),
			120 => 
			array (
				'id' => 250,
				'group_id' => 7,
				'name' => 'Fugiat earum sed.',
				'proteins' => '0.5',
				'lipids' => '1.0',
				'disaccharides' => '0.1',
				'starch' => '0.8',
				'energy_value' => 311,
			),
			121 => 
			array (
				'id' => 251,
				'group_id' => 7,
				'name' => 'Pariatur aut.',
				'proteins' => '0.2',
				'lipids' => '0.4',
				'disaccharides' => '0.7',
				'starch' => '0.1',
				'energy_value' => 129,
			),
			122 => 
			array (
				'id' => 252,
				'group_id' => 7,
				'name' => 'Dicta et laboriosam.',
				'proteins' => '0.7',
				'lipids' => '0.6',
				'disaccharides' => '0.2',
				'starch' => '0.2',
				'energy_value' => 227,
			),
			123 => 
			array (
				'id' => 254,
				'group_id' => 8,
				'name' => 'Autem consequuntur.',
				'proteins' => '0.4',
				'lipids' => '0.0',
				'disaccharides' => '0.1',
				'starch' => '0.3',
				'energy_value' => 186,
			),
			124 => 
			array (
				'id' => 255,
				'group_id' => 8,
				'name' => 'Ab et fuga.',
				'proteins' => '0.2',
				'lipids' => '0.9',
				'disaccharides' => '0.1',
				'starch' => '0.8',
				'energy_value' => 72,
			),
			125 => 
			array (
				'id' => 256,
				'group_id' => 8,
				'name' => 'Minima.',
				'proteins' => '0.6',
				'lipids' => '0.5',
				'disaccharides' => '0.1',
				'starch' => '0.4',
				'energy_value' => 103,
			),
			126 => 
			array (
				'id' => 257,
				'group_id' => 8,
				'name' => 'Esse quam sed.',
				'proteins' => '0.9',
				'lipids' => '0.8',
				'disaccharides' => '0.7',
				'starch' => '0.8',
				'energy_value' => 238,
			),
			127 => 
			array (
				'id' => 258,
				'group_id' => 8,
				'name' => 'Repudiandae labore.',
				'proteins' => '0.2',
				'lipids' => '0.4',
				'disaccharides' => '0.2',
				'starch' => '0.0',
				'energy_value' => 361,
			),
			128 => 
			array (
				'id' => 259,
				'group_id' => 8,
				'name' => 'Vero.',
				'proteins' => '0.2',
				'lipids' => '0.9',
				'disaccharides' => '0.6',
				'starch' => '0.8',
				'energy_value' => 39,
			),
			129 => 
			array (
				'id' => 262,
				'group_id' => 10,
				'name' => 'Eos ea.',
				'proteins' => '1.0',
				'lipids' => '1.0',
				'disaccharides' => '0.4',
				'starch' => '0.7',
				'energy_value' => 192,
			),
		));
	}

}