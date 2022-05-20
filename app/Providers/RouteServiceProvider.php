<?php

namespace App\Providers;

use App\Offer;
use App\Repositories\OrdersRepository;
use App\UserHistory;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Users;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->bind('offer', function ($id) {
            return Offer::findOrFail($id);
        });

        $router->bind('customer', function ($id) {
            return Users::findAny((int) $id);
        });

        $router->bind('record', function ($id) use ($router) {

            if ($customer = $router->current()->parameter('customer')) {
                return $customer->history()->full()->where('id', (int) $id)->firstOrFail();
            }

            return UserHistory::full()->findOrFail((int) $id);
        });

        $router->bind('order', function ($key) {
            return app(OrdersRepository::class)->find((int) $key);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
