<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('options')->delete();

        \DB::table('options')->insert([
                0 =>
                        [
                                'id'    => 1,
                                'key'   => 'admin::email',
                                'value' => 'admin@unicasport.com',
                                'group' => 'site',
                        ],
                1 =>
                        [
                                'id'    => 2,
                                'key'   => 'support::email',
                                'value' => 'info@unicasport.com',
                                'group' => 'site',
                        ],

        ]);
    }

}
