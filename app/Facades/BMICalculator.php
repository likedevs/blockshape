<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class BMICalculator extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'BMICalculator';
    }
}