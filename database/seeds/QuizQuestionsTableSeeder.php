<?php

use Illuminate\Database\Seeder;

class QuizQuestionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('quiz_questions')->delete();

        \DB::table('quiz_questions')->insert([
            0  =>
                [
                    'id'              => 1,
                    'question'        => 'De cîte ori pe săptămînă consumați carne',
                    'answer_group_id' => 1,
                ],
            1  =>
                [
                    'id'              => 2,
                    'question'        => 'De cîte ori pe săptămînă consumați pește',
                    'answer_group_id' => 1,
                ],
            2  =>
                [
                    'id'              => 3,
                    'question'        => 'De cîte ori pe săptămînă consumați ouă',
                    'answer_group_id' => 1,
                ],
            3  =>
                [
                    'id'              => 4,
                    'question'        => 'De cîte ori pe săptămînă consumați brînză, cașcaval',
                    'answer_group_id' => 1,
                ],
            4  =>
                [
                    'id'              => 5,
                    'question'        => 'De cîte ori pe săptămînă consumați produse lacto-acide',
                    'answer_group_id' => 1,
                ],
            5  =>
                [
                    'id'              => 6,
                    'question'        => 'De cîte ori pe săptămînă consumați: Hrișcă, ovăz, grîu',
                    'answer_group_id' => 1,
                ],
            6  =>
                [
                    'id'              => 7,
                    'question'        => 'De cîte ori pe săptămînă consumați pîine neagră și produse din făină de tărite',
                    'answer_group_id' => 1,
                ],
            7  =>
                [
                    'id'              => 8,
                    'question'        => 'De cîte ori pe săptămînă consumați unt',
                    'answer_group_id' => 1,
                ],
            8  =>
                [
                    'id'              => 9,
                    'question'        => 'De cîte ori pe săptămînă consumați ulei vegetal',
                    'answer_group_id' => 1,
                ],
            9  =>
                [
                    'id'              => 10,
                    'question'        => 'De cîte ori pe săptămînă consumați maioneză',
                    'answer_group_id' => 1,
                ],
            10 =>
                [
                    'id'              => 11,
                    'question'        => 'De cîte ori pe săptămînă consumați patisserie, tort, prăjituri',
                    'answer_group_id' => 1,
                ],
            11 =>
                [
                    'id'              => 12,
                    'question'        => 'De cîte ori pe săptămînă consumați ciocolate, bomboane',
                    'answer_group_id' => 1,
                ],
            12 =>
                [
                    'id'              => 13,
                    'question'        => 'De cîte ori pe săptămînă consumați Nuci,arahide,seminte ',
                    'answer_group_id' => 1,
                ],
            13 =>
                [
                    'id'              => 14,
                    'question'        => 'De cîte ori pe săptămînă consumați mezeluri',
                    'answer_group_id' => 1,
                ],
            14 =>
                [
                    'id'              => 16,
                    'question'        => 'De căte ori pe zi luați masa',
                    'answer_group_id' => 2,
                ],
            15 =>
                [
                    'id'              => 17,
                    'question'        => 'Ce cantitate de apă pe zi consumati',
                    'answer_group_id' => 3,
                ],
            16 =>
                [
                    'id'              => 18,
                    'question'        => 'Ce cantitate de ceai/cafea pe zi consumați',
                    'answer_group_id' => 4,
                ],
            17 =>
                [
                    'id'              => 19,
                    'question'        => 'Cit de des consumați suc fresh',
                    'answer_group_id' => 6,
                ],
            18 =>
                [
                    'id'              => 20,
                    'question'        => 'Cit de des consumați suc tetrapac',
                    'answer_group_id' => 6,
                ],
            19 =>
                [
                    'id'              => 21,
                    'question'        => 'Cit de des consumați suc bauturi carbogazoase',
                    'answer_group_id' => 6,
                ],
            20 =>
                [
                    'id'              => 22,
                    'question'        => 'Cit de des consumați alcool',
                    'answer_group_id' => 6,
                ],
        ]);
    }

}
