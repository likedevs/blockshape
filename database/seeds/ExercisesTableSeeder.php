<?php

use Illuminate\Database\Seeder;

class ExercisesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('exercises')->delete();

        \DB::table('exercises')->insert([
            0 =>
                [
                    'id'   => 1,
                    'name' => 'Coapsa interna',
                ],
            1 =>
                [
                    'id'   => 2,
                    'name' => 'Coapsa laterala',
                ],
            2 =>
                [
                    'id'   => 3,
                    'name' => 'Fese',
                ],
            3 =>
                [
                    'id'   => 4,
                    'name' => 'Abdomen  portiunea superiora',
                ],
            4 =>
                [
                    'id'   => 5,
                    'name' => 'Oblici',
                ],
            5 =>
                [
                    'id'   => 6,
                    'name' => 'Complex de baza',
                ],
        ]);
    }

}
