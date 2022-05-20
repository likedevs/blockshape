<?php

use Illuminate\Database\Seeder;

class AllergiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('allergies')->delete();

        \DB::table('allergies')->insert([
            0 =>
                [
                    'id'   => 1,
                    'name' => 'Miere de albini',
                ],
            1 =>
                [
                    'id'   => 2,
                    'name' => 'Rosii',
                ],
            2 =>
                [
                    'id'   => 3,
                    'name' => 'Oua',
                ],
            3 =>
                [
                    'id'   => 4,
                    'name' => 'Citrice',
                ],
            4 =>
                [
                    'id'   => 5,
                    'name' => 'Arahide',
                ],
        ]);
    }

}
