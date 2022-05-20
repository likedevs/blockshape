<?php

use Illuminate\Database\Seeder;

class FoodExcludesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('food_excludes')->delete();

        \DB::table('food_excludes')->insert([
            0 =>
                [
                    'id'   => 1,
                    'name' => 'Carne',
                    'note' => '<p>Importanta carnei</p>',
                ],
            1 =>
                [
                    'id'   => 2,
                    'name' => 'Oua',
                    'note' => '<p>Importanta Oua</p>',
                ],
            2 =>
                [
                    'id'   => 3,
                    'name' => 'Lactate',
                    'note' => '<p>Importanta lactate</p>',
                ],
            3 =>
                [
                    'id'   => 4,
                    'name' => 'Citrice',
                    'note' => '<p>Importanta citrice</p>',
                ],
        ]);
    }

}
