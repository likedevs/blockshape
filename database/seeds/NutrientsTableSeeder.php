<?php

use Illuminate\Database\Seeder;

class NutrientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('nutrients')->delete();

        \DB::table('nutrients')->insert([
            0 =>
                [
                    'id'   => 1,
                    'name' => 'Proteine',
                    'slug' => 'proteins',
                ],
            1 =>
                [
                    'id'   => 2,
                    'name' => 'Glucide',
                    'slug' => 'carbohydrates',
                ],
            2 =>
                [
                    'id'   => 3,
                    'name' => 'Proteine + Glucide',
                    'slug' => 'proteins-carbohydrates',
                ],
            3 =>
                [
                    'id'   => 4,
                    'name' => 'Lipide',
                    'slug' => 'lipids',
                ],
        ]);
    }

}
