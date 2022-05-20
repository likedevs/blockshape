<?php

use Illuminate\Database\Seeder;
use Terranet\Multilingual\Language;

class LanguagesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->delete();

        Language::create(['title' => 'Română',  'slug' => 'ro', 'active' => true, 'rank' => 1]);
        Language::create(['title' => 'Русский', 'slug' => 'ru', 'active' => true, 'rank' => 2]);
        Language::create(['title' => 'English', 'slug' => 'en', 'active' => true, 'rank' => 3]);
    }
}