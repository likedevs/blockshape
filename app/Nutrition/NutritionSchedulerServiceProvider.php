<?php namespace App\Nutrition;

use Illuminate\Support\ServiceProvider;

class NutritionSchedulerServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('LoadScheduler', function ($app) {
            return new LoadScheduler($app);
        });

        $this->app->bind('RestScheduler', function ($app) {
            return new RestScheduler($app);
        });
    }

    public function providers()
    {
        return ['LoadScheduler', 'RestScheduler'];
    }

}
