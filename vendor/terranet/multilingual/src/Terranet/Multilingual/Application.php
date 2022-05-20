<?php namespace Terranet\Multilingual;

use Illuminate\Events\EventServiceProvider;
use Illuminate\Foundation\Application as Container;

class Application extends Container
{
    /**
     * Register all of the base service providers.
     *
     * @return void
     */
    protected function registerBaseServiceProviders()
    {
        $this->register(new EventServiceProvider($this));

        $this->register(new RoutingServiceProvider($this));
    }
}