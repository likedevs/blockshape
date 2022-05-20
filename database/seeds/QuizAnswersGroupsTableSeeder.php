<?php

use Illuminate\Database\Seeder;

class QuizAnswersGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('quiz_answers_groups')->delete();

        \DB::table('quiz_answers_groups')->insert([
                0 =>
                        [
                                'id'   => 1,
                                'name' => 'Group 1 - Times per week',
                        ],
                1 =>
                        [
                                'id'   => 2,
                                'name' => 'Group 2 - Food times per day',
                        ],
                2 =>
                        [
                                'id'   => 3,
                                'name' => 'Group 3 - Water per day',
                        ],
                3 =>
                        [
                                'id'   => 4,
                                'name' => 'Group 4 - Tea/Coffee per day',
                        ],
                4 =>
                        [
                                'id'   => 5,
                                'name' => 'Group 5 - Fresh juices per day',
                        ],
                5 =>
                        [
                                'id'   => 6,
                                'name' => 'Group 6 - Tetrapac juices per day',
                        ],
                6 =>
                        [
                                'id'   => 7,
                                'name' => 'Group 7 - Alcohol per day',
                        ],
        ]);
    }

}
