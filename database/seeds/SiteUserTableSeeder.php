<?php

use Illuminate\Database\Seeder;

class SiteUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::whereNull('site_id')->chunk(100, function($chunk) {
            $chunk->each(function($user) {
                $user->fill([
                    'site_id' => 1
                ])->save();
            });
        });
    }
}
