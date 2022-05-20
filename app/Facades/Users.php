<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Users extends Facade
{
    static public function getFacadeAccessor()
    {
        return 'App\Repositories\UsersRepository';
    }
}