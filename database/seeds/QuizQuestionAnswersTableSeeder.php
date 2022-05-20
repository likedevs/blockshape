<?php

use Illuminate\Database\Seeder;

class QuizQuestionAnswersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('quiz_question_answers')->delete();

        \DB::table('quiz_question_answers')->insert([
                0  =>
                        [
                                'id'          => 11,
                                'question_id' => 1,
                                'answer_id'   => 1,
                                'hint_id'     => 6,
                        ],
                1  =>
                        [
                                'id'          => 14,
                                'question_id' => 1,
                                'answer_id'   => 2,
                                'hint_id'     => 6,
                        ],
                2  =>
                        [
                                'id'          => 17,
                                'question_id' => 1,
                                'answer_id'   => 3,
                                'hint_id'     => 2,
                        ],
                3  =>
                        [
                                'id'          => 18,
                                'question_id' => 1,
                                'answer_id'   => 4,
                                'hint_id'     => 2,
                        ],
                4  =>
                        [
                                'id'          => 19,
                                'question_id' => 1,
                                'answer_id'   => 4,
                                'hint_id'     => 8,
                        ],
                5  =>
                        [
                                'id'          => 20,
                                'question_id' => 2,
                                'answer_id'   => 1,
                                'hint_id'     => 1,
                        ],
                6  =>
                        [
                                'id'          => 21,
                                'question_id' => 2,
                                'answer_id'   => 1,
                                'hint_id'     => 3,
                        ],
                7  =>
                        [
                                'id'          => 22,
                                'question_id' => 2,
                                'answer_id'   => 2,
                                'hint_id'     => 1,
                        ],
                8  =>
                        [
                                'id'          => 23,
                                'question_id' => 2,
                                'answer_id'   => 2,
                                'hint_id'     => 3,
                        ],
                9  =>
                        [
                                'id'          => 24,
                                'question_id' => 2,
                                'answer_id'   => 3,
                                'hint_id'     => 2,
                        ],
                10 =>
                        [
                                'id'          => 25,
                                'question_id' => 2,
                                'answer_id'   => 4,
                                'hint_id'     => 2,
                        ],
                11 =>
                        [
                                'id'          => 26,
                                'question_id' => 2,
                                'answer_id'   => 4,
                                'hint_id'     => 8,
                        ],
                12 =>
                        [
                                'id'          => 30,
                                'question_id' => 3,
                                'answer_id'   => 3,
                                'hint_id'     => 2,
                        ],
                13 =>
                        [
                                'id'          => 31,
                                'question_id' => 3,
                                'answer_id'   => 4,
                                'hint_id'     => 2,
                        ],
                14 =>
                        [
                                'id'          => 32,
                                'question_id' => 4,
                                'answer_id'   => 1,
                                'hint_id'     => 3,
                        ],
                15 =>
                        [
                                'id'          => 34,
                                'question_id' => 4,
                                'answer_id'   => 2,
                                'hint_id'     => 3,
                        ],
                16 =>
                        [
                                'id'          => 35,
                                'question_id' => 4,
                                'answer_id'   => 3,
                                'hint_id'     => 2,
                        ],
                17 =>
                        [
                                'id'          => 36,
                                'question_id' => 4,
                                'answer_id'   => 3,
                                'hint_id'     => 8,
                        ],
                18 =>
                        [
                                'id'          => 37,
                                'question_id' => 4,
                                'answer_id'   => 4,
                                'hint_id'     => 2,
                        ],
                19 =>
                        [
                                'id'          => 38,
                                'question_id' => 4,
                                'answer_id'   => 4,
                                'hint_id'     => 8,
                        ],
                20 =>
                        [
                                'id'          => 40,
                                'question_id' => 5,
                                'answer_id'   => 1,
                                'hint_id'     => 3,
                        ],
                21 =>
                        [
                                'id'          => 41,
                                'question_id' => 5,
                                'answer_id'   => 2,
                                'hint_id'     => 3,
                        ],
                22 =>
                        [
                                'id'          => 46,
                                'question_id' => 6,
                                'answer_id'   => 1,
                                'hint_id'     => 12,
                        ],
                23 =>
                        [
                                'id'          => 47,
                                'question_id' => 6,
                                'answer_id'   => 1,
                                'hint_id'     => 13,
                        ],
                24 =>
                        [
                                'id'          => 48,
                                'question_id' => 6,
                                'answer_id'   => 2,
                                'hint_id'     => 13,
                        ],
                25 =>
                        [
                                'id'          => 49,
                                'question_id' => 7,
                                'answer_id'   => 1,
                                'hint_id'     => 12,
                        ],
                26 =>
                        [
                                'id'          => 50,
                                'question_id' => 7,
                                'answer_id'   => 1,
                                'hint_id'     => 13,
                        ],
                27 =>
                        [
                                'id'          => 51,
                                'question_id' => 7,
                                'answer_id'   => 2,
                                'hint_id'     => 12,
                        ],
                28 =>
                        [
                                'id'          => 52,
                                'question_id' => 7,
                                'answer_id'   => 2,
                                'hint_id'     => 13,
                        ],
                29 =>
                        [
                                'id'          => 55,
                                'question_id' => 8,
                                'answer_id'   => 3,
                                'hint_id'     => 8,
                        ],
                30 =>
                        [
                                'id'          => 56,
                                'question_id' => 8,
                                'answer_id'   => 4,
                                'hint_id'     => 8,
                        ],
                31 =>
                        [
                                'id'          => 57,
                                'question_id' => 9,
                                'answer_id'   => 1,
                                'hint_id'     => 7,
                        ],
                32 =>
                        [
                                'id'          => 58,
                                'question_id' => 9,
                                'answer_id'   => 2,
                                'hint_id'     => 7,
                        ],
                33 =>
                        [
                                'id'          => 59,
                                'question_id' => 9,
                                'answer_id'   => 3,
                                'hint_id'     => 8,
                        ],
                34 =>
                        [
                                'id'          => 60,
                                'question_id' => 9,
                                'answer_id'   => 4,
                                'hint_id'     => 8,
                        ],
                35 =>
                        [
                                'id'          => 61,
                                'question_id' => 10,
                                'answer_id'   => 3,
                                'hint_id'     => 8,
                        ],
                36 =>
                        [
                                'id'          => 62,
                                'question_id' => 10,
                                'answer_id'   => 4,
                                'hint_id'     => 8,
                        ],
                37 =>
                        [
                                'id'          => 63,
                                'question_id' => 11,
                                'answer_id'   => 4,
                                'hint_id'     => 8,
                        ],
                38 =>
                        [
                                'id'          => 64,
                                'question_id' => 11,
                                'answer_id'   => 3,
                                'hint_id'     => 8,
                        ],
                39 =>
                        [
                                'id'          => 65,
                                'question_id' => 12,
                                'answer_id'   => 4,
                                'hint_id'     => 8,
                        ],
                40 =>
                        [
                                'id'          => 66,
                                'question_id' => 12,
                                'answer_id'   => 3,
                                'hint_id'     => 8,
                        ],
                41 =>
                        [
                                'id'          => 68,
                                'question_id' => 13,
                                'answer_id'   => 1,
                                'hint_id'     => 14,
                        ],
                42 =>
                        [
                                'id'          => 80,
                                'question_id' => 16,
                                'answer_id'   => 5,
                                'hint_id'     => 9,
                        ],
                43 =>
                        [
                                'id'          => 81,
                                'question_id' => 16,
                                'answer_id'   => 6,
                                'hint_id'     => 9,
                        ],
                44 =>
                        [
                                'id'          => 82,
                                'question_id' => 17,
                                'answer_id'   => 8,
                                'hint_id'     => 11,
                        ],
                45 =>
                        [
                                'id'          => 83,
                                'question_id' => 17,
                                'answer_id'   => 9,
                                'hint_id'     => 11,
                        ],
                46 =>
                        [
                                'id'          => 85,
                                'question_id' => 18,
                                'answer_id'   => 14,
                                'hint_id'     => 10,
                        ],
                47 =>
                        [
                                'id'          => 87,
                                'question_id' => 22,
                                'answer_id'   => 21,
                                'hint_id'     => 10,
                        ],
                48 =>
                        [
                                'id'          => 89,
                                'question_id' => 1,
                                'answer_id'   => 1,
                                'hint_id'     => 1,
                        ],
                49 =>
                        [
                                'id'          => 90,
                                'question_id' => 2,
                                'answer_id'   => 1,
                                'hint_id'     => 5,
                        ],
                50 =>
                        [
                                'id'          => 91,
                                'question_id' => 2,
                                'answer_id'   => 1,
                                'hint_id'     => 6,
                        ],
                51 =>
                        [
                                'id'          => 92,
                                'question_id' => 2,
                                'answer_id'   => 1,
                                'hint_id'     => 7,
                        ],
                52 =>
                        [
                                'id'          => 93,
                                'question_id' => 3,
                                'answer_id'   => 1,
                                'hint_id'     => 5,
                        ],
                53 =>
                        [
                                'id'          => 94,
                                'question_id' => 3,
                                'answer_id'   => 1,
                                'hint_id'     => 6,
                        ],
                54 =>
                        [
                                'id'          => 95,
                                'question_id' => 3,
                                'answer_id'   => 1,
                                'hint_id'     => 15,
                        ],
                55 =>
                        [
                                'id'          => 96,
                                'question_id' => 4,
                                'answer_id'   => 1,
                                'hint_id'     => 5,
                        ],
                56 =>
                        [
                                'id'          => 97,
                                'question_id' => 4,
                                'answer_id'   => 1,
                                'hint_id'     => 11,
                        ],
                57 =>
                        [
                                'id'          => 98,
                                'question_id' => 5,
                                'answer_id'   => 1,
                                'hint_id'     => 15,
                        ],
                58 =>
                        [
                                'id'          => 99,
                                'question_id' => 5,
                                'answer_id'   => 2,
                                'hint_id'     => 15,
                        ],
                59 =>
                        [
                                'id'          => 100,
                                'question_id' => 6,
                                'answer_id'   => 1,
                                'hint_id'     => 14,
                        ],
                60 =>
                        [
                                'id'          => 101,
                                'question_id' => 6,
                                'answer_id'   => 1,
                                'hint_id'     => 15,
                        ],
                61 =>
                        [
                                'id'          => 102,
                                'question_id' => 6,
                                'answer_id'   => 2,
                                'hint_id'     => 12,
                        ],
                62 =>
                        [
                                'id'          => 103,
                                'question_id' => 6,
                                'answer_id'   => 2,
                                'hint_id'     => 14,
                        ],
                63 =>
                        [
                                'id'          => 104,
                                'question_id' => 6,
                                'answer_id'   => 2,
                                'hint_id'     => 15,
                        ],
                64 =>
                        [
                                'id'          => 105,
                                'question_id' => 7,
                                'answer_id'   => 1,
                                'hint_id'     => 14,
                        ],
                65 =>
                        [
                                'id'          => 106,
                                'question_id' => 7,
                                'answer_id'   => 2,
                                'hint_id'     => 14,
                        ],
                66 =>
                        [
                                'id'          => 107,
                                'question_id' => 9,
                                'answer_id'   => 1,
                                'hint_id'     => 15,
                        ],
                67 =>
                        [
                                'id'          => 108,
                                'question_id' => 9,
                                'answer_id'   => 2,
                                'hint_id'     => 15,
                        ],
                68 =>
                        [
                                'id'          => 110,
                                'question_id' => 13,
                                'answer_id'   => 1,
                                'hint_id'     => 6,
                        ],
                69 =>
                        [
                                'id'          => 111,
                                'question_id' => 13,
                                'answer_id'   => 1,
                                'hint_id'     => 7,
                        ],
                70 =>
                        [
                                'id'          => 112,
                                'question_id' => 13,
                                'answer_id'   => 1,
                                'hint_id'     => 15,
                        ],
                71 =>
                        [
                                'id'          => 113,
                                'question_id' => 14,
                                'answer_id'   => 2,
                                'hint_id'     => 8,
                        ],
                72 =>
                        [
                                'id'          => 114,
                                'question_id' => 14,
                                'answer_id'   => 3,
                                'hint_id'     => 8,
                        ],
                73 =>
                        [
                                'id'          => 115,
                                'question_id' => 14,
                                'answer_id'   => 4,
                                'hint_id'     => 8,
                        ],
                74 =>
                        [
                                'id'          => 116,
                                'question_id' => 20,
                                'answer_id'   => 21,
                                'hint_id'     => 10,
                        ],
                75 =>
                        [
                                'id'          => 117,
                                'question_id' => 20,
                                'answer_id'   => 18,
                                'hint_id'     => 10,
                        ],
                76 =>
                        [
                                'id'          => 118,
                                'question_id' => 21,
                                'answer_id'   => 18,
                                'hint_id'     => 10,
                        ],
                77 =>
                        [
                                'id'          => 119,
                                'question_id' => 21,
                                'answer_id'   => 19,
                                'hint_id'     => 10,
                        ],
                78 =>
                        [
                                'id'          => 120,
                                'question_id' => 22,
                                'answer_id'   => 18,
                                'hint_id'     => 10,
                        ],
                79 =>
                        [
                                'id'          => 121,
                                'question_id' => 22,
                                'answer_id'   => 19,
                                'hint_id'     => 10,
                        ],
                80 =>
                        [
                                'id'          => 122,
                                'question_id' => 22,
                                'answer_id'   => 20,
                                'hint_id'     => 10,
                        ],
        ]);
    }

}
