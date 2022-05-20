<?php namespace Terranet\Multilingual;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Composer;
use Illuminate\Translation\TranslationServiceProvider as IlluminateTranslationServiceProvider;
use Terranet\Multilingual\Console\TableCommand;

class MultilingualServiceProvider extends IlluminateTranslationServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepository();

        $this->registerLoader();

        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];

            // When registering the translator component, we'll need to set the default
            // locale as well as the fallback locale. So, we'll grab the application
            // configuration so we can easily get both of these values from there.
            $locale = $app['config']['app.locale'];

            $trans = new Translator($loader, $locale);

            $trans->setApplication($app);

            $trans->setRepository($app['multilingual.repository']);

            $trans->setFallback($app['config']['app.fallback_locale']);

            $trans->resolve(1);

            return $trans;
        });

        $this->app->bindShared('languages:table', function () {
            return new TableCommand($filesystem = new Filesystem, new Composer($filesystem));
        });

        $this->commands(['languages:table']);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/LanguagesTableSeeder.php' => base_path('database/seeds/LanguagesTableSeeder.php'),
        ]);
    }

    private function registerRepository()
    {
        $this->app['multilingual.repository'] = $this->app->share(function () {
            return new LanguagesRepository(new Language());
        });
    }
}