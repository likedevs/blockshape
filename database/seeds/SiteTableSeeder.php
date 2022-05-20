<?php

use Illuminate\Database\Seeder;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Site::create([
            'name' => 'UnicaSport MD',
            'domain' => 'http://alimentatie.unicasport.md',
            'currency' => 'MDL',
        ]);

        App\Site::create([
            'name' => 'UnicaSport RO',
            'domain' => 'http://alimentatie.unicasport.ro',
            'currency' => 'RON',
        ]);
    }
}
