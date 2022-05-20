<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('languages')->delete();

        Terranet\Multilingual\Language::create(['title' => 'Română',  'slug' => 'ro', 'active' => true, 'rank' => 1]);
        Terranet\Multilingual\Language::create(['title' => 'Русский', 'slug' => 'ru', 'active' => true, 'rank' => 2]);
        Terranet\Multilingual\Language::create(['title' => 'English', 'slug' => 'en', 'active' => true, 'rank' => 3]);
    }
}