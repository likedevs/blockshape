<?php namespace Terranet\Restable;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResponseFactory;
use League\Fractal\Manager AS FractalManager;

class RestableServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/restable.php';

        // Publish config.
        $this->publishes([$configPath => config_path('restable.php')], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/restable.php';

        // Merge config to allow user overwrite.
        $this->mergeConfigFrom($configPath, 'restable');

        $this->app['restable'] = $this->app->share(function ($app)
        {
            $response = new ResponseFactory($app['view'], $app['redirect']);

            $converter = new Format;

            return new FractalDecorator(
                new SelfRenderedAdapter(new Restable($app['config'], $response, $converter)),
                new FractalManager
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['restable'];
    }

}