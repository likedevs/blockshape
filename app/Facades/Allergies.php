<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Allergies extends Facade
{
    static public function getFacadeAccessor()
    {
        return 'App\Repositories\AllergiesRepository';
    }
}