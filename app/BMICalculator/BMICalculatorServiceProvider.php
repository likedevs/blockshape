<?php namespace App\BMICalculator;

use Illuminate\Support\ServiceProvider;

class BMICalculatorServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('BMICalculator', function ($app) {
            return new Manager($app);
        });
    }

}
