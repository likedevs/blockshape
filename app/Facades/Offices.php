<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Offices extends Facade
{
    static public function getFacadeAccessor()
    {
        return 'App\Repositories\DepartmentsRepository';
    }
}