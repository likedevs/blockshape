<?php

use Illuminate\Database\Seeder;

class OfficesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('offices')->delete();

        \DB::table('offices')->insert([
            0  =>
                [
                    'id'      => 1,
                    'name'    => 'Bioritm 1',
                    'address' => 'Stefan cel mare 88',
                ],
            1  =>
                [
                    'id'      => 2,
                    'name'    => 'Bio Forma',
                    'address' => null,
                ],
            2  =>
                [
                    'id'      => 3,
                    'name'    => 'Bio Body',
                    'address' => null,
                ],
            3  =>
                [
                    'id'      => 4,
                    'name'    => 'Bio Style',
                    'address' => null,
                ],
            4  =>
                [
                    'id'      => 5,
                    'name'    => 'Silueta+',
                    'address' => null,
                ],
            5  =>
                [
                    'id'      => 6,
                    'name'    => 'Star Studio',
                    'address' => null,
                ],
            6  =>
                [
                    'id'      => 7,
                    'name'    => 'Bios',
                    'address' => null,
                ],
            7  =>
                [
                    'id'      => 8,
                    'name'    => 'Bio Star',
                    'address' => null,
                ],
            8  =>
                [
                    'id'      => 9,
                    'name'    => 'Sport+',
                    'address' => null,
                ],
            9  =>
                [
                    'id'      => 10,
                    'name'    => 'Bioritm 2',
                    'address' => null,
                ],
            10 =>
                [
                    'id'      => 11,
                    'name'    => 'Bioshape',
                    'address' => null,
                ],
            11 =>
                [
                    'id'      => 12,
                    'name'    => 'Unica Men',
                    'address' => null,
                ],
            12 =>
                [
                    'id'      => 13,
                    'name'    => 'Bio Life',
                    'address' => null,
                ],
            13 =>
                [
                    'id'      => 14,
                    'name'    => 'Sport Line',
                    'address' => null,
                ],
            14 =>
                [
                    'id'      => 15,
                    'name'    => 'Body Slim',
                    'address' => null,
                ],
            15 =>
                [
                    'id'      => 16,
                    'name'    => 'Shape +',
                    'address' => null,
                ],
            16 =>
                [
                    'id'      => 17,
                    'name'    => 'Life+',
                    'address' => null,
                ],
            17 =>
                [
                    'id'      => 18,
                    'name'    => 'Silueta+ nr.2',
                    'address' => null,
                ],
        ]);
    }

}
