<?php

use Illuminate\Database\Seeder;

class QuizAnswersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('quiz_answers')->delete();

        \DB::table('quiz_answers')->insert([
                0  =>
                        [
                                'id'       => 1,
                                'answer'   => 'Nu folosesc ',
                                'group_id' => 1,
                                'rank'     => 1,
                        ],
                1  =>
                        [
                                'id'       => 2,
                                'answer'   => 'Mai putin de 4 ori',
                                'group_id' => 1,
                                'rank'     => 2,
                        ],
                2  =>
                        [
                                'id'       => 3,
                                'answer'   => '4-6 ori',
                                'group_id' => 1,
                                'rank'     => 3,
                        ],
                3  =>
                        [
                                'id'       => 4,
                                'answer'   => '7 ori',
                                'group_id' => 1,
                                'rank'     => 4,
                        ],
                4  =>
                        [
                                'id'       => 5,
                                'answer'   => 'Mai putin de trei ori',
                                'group_id' => 2,
                                'rank'     => 1,
                        ],
                5  =>
                        [
                                'id'       => 6,
                                'answer'   => 'De trei ori',
                                'group_id' => 2,
                                'rank'     => 2,
                        ],
                6  =>
                        [
                                'id'       => 7,
                                'answer'   => '4-6 ori',
                                'group_id' => 2,
                                'rank'     => 3,
                        ],
                7  =>
                        [
                                'id'       => 8,
                                'answer'   => '0.5 litri',
                                'group_id' => 3,
                                'rank'     => 1,
                        ],
                8  =>
                        [
                                'id'       => 9,
                                'answer'   => '1 litru',
                                'group_id' => 3,
                                'rank'     => 2,
                        ],
                9  =>
                        [
                                'id'       => 10,
                                'answer'   => '1.5 litri',
                                'group_id' => 3,
                                'rank'     => 3,
                        ],
                10 =>
                        [
                                'id'       => 11,
                                'answer'   => '2 litri',
                                'group_id' => 3,
                                'rank'     => 4,
                        ],
                11 =>
                        [
                                'id'       => 12,
                                'answer'   => '1 cana',
                                'group_id' => 4,
                                'rank'     => 1,
                        ],
                12 =>
                        [
                                'id'       => 13,
                                'answer'   => '2 cani ',
                                'group_id' => 4,
                                'rank'     => 2,
                        ],
                13 =>
                        [
                                'id'       => 14,
                                'answer'   => '3 cani si mai mult',
                                'group_id' => 4,
                                'rank'     => 3,
                        ],
                14 =>
                        [
                                'id'       => 15,
                                'answer'   => '1 pahar',
                                'group_id' => 5,
                                'rank'     => 1,
                        ],
                15 =>
                        [
                                'id'       => 16,
                                'answer'   => '2 pahare',
                                'group_id' => 5,
                                'rank'     => 2,
                        ],
                16 =>
                        [
                                'id'       => 17,
                                'answer'   => 'deloc',
                                'group_id' => 5,
                                'rank'     => 3,
                        ],
                17 =>
                        [
                                'id'       => 18,
                                'answer'   => 'Zilnic ',
                                'group_id' => 6,
                                'rank'     => 1,
                        ],
                18 =>
                        [
                                'id'       => 19,
                                'answer'   => 'Rar',
                                'group_id' => 6,
                                'rank'     => 2,
                        ],
                19 =>
                        [
                                'id'       => 20,
                                'answer'   => 'Ocazional',
                                'group_id' => 6,
                                'rank'     => 3,
                        ],
                20 =>
                        [
                                'id'       => 21,
                                'answer'   => 'Zilnic',
                                'group_id' => 7,
                                'rank'     => 1,
                        ],
                21 =>
                        [
                                'id'       => 22,
                                'answer'   => 'Rar',
                                'group_id' => 7,
                                'rank'     => 2,
                        ],
                22 =>
                        [
                                'id'       => 26,
                                'answer'   => 'Ocazional',
                                'group_id' => 7,
                                'rank'     => 3,
                        ],
                23 =>
                        [
                                'id'       => 27,
                                'answer'   => 'mai mult de 2 litri',
                                'group_id' => 3,
                                'rank'     => 5,
                        ],
                24 =>
                        [
                                'id'       => 29,
                                'answer'   => 'Deloc',
                                'group_id' => 6,
                                'rank'     => 5,
                        ],
        ]);
    }

}
