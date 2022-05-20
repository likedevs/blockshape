<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        User::create([
            'id'       => 1,
            'name'     => 'Administrator',
            'email'    => 'admin@unicasport.com',
            'password' => bcrypt('secret'),
            'role'     => 'admin',
            'active'   => 1
        ]);

        User::create([
            'id'       => 1,
            'name'     => 'Jean-Claude Van Damme',
            'email'    => 'vandam@unicasport.com',
            'password' => bcrypt('secret'),
            'role'     => 'instructor',
            'active'   => 1
        ]);

        factory(User::class, 10)->create();
    }
}
