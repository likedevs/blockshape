<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Terranet\VictoriaBank\Gateway\Merchant;
use Terranet\VictoriaBank\Gateway\Request;
use Terranet\VictoriaBank\Gateway\Response;
use Terranet\VictoriaBank\Gateway\Security;
use Terranet\VictoriaBank\VbService;

class VbServiceProvider extends ServiceProvider
{
    protected $dir;

    protected $defer = true;

    public function __construct($app)
    {
        $this->dir = base_path('vendor/terranet/victoria-bank-payment/src');

        parent::__construct($app);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->routesAreCached())
            require $this->dir . '/../routes.php';

        $this->mergeConfigFrom(
            config_path("vb" . site_id() . '.php'),
            'vb'
        );

        /**
         * Create Security instance .
         */
        $this->app->bind('vb-security', function () {
            return new Security(
                config('vb.hash'),
                config('vb.prefix'),
                app_path('../' . config('vb.public_key_path')),
                app_path('../' . config('vb.private_key_path')),
                app_path('../' . config('vb.public_bank_key_path'))
            );
        });

        /**
         * Register VbResponse instance .
         *
         */
        $this->app->bind('vb-response', function ($app)  {
            $response = new Response(
                app('request')->all(),
                config('vb.response_prefix', '3020300C06082A864886F70D020505000410')
            );

            $response->setSecurity($app['vb-security']);

            return $response;
        });

        /**
         * Register security as singleton instance .
         *
         */
        $this->app->bind('vb-request', function ($app) {
            $request = new Request(
                config('vb.currency', 'MDL'),
                config('vb.language', 'en'),
                config('vb.country', 'MD')
            );

            /** Set debug mode . */
            $request->setDebugMode(config('vb.debug', false));

            $request->setMerchant(app('vb-merchant'));

            $request->setSecurity($app['vb-security']);

            return $request;
        });

        /**
         * Register vb service instance ..
         *
         */
        $this->app->bind('vb-service', function () {
            return new VbService;
        });

        $this->app->bind('vb-merchant', function () {
            return new Merchant(
                config('vb.merchant_id'),
                config('vb.merchant_name'),
                config('vb.merchant_url'),
                config('vb.merchant_address'),
                config('vb.merchant_terminal_id'),
                config('vb.gmt', '+2') // By default use Europe/Chisinau timezone
            );
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
