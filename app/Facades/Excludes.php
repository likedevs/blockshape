<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Excludes extends Facade
{
    static public function getFacadeAccessor()
    {
        return 'App\Repositories\ExcludesRepository';
    }
}