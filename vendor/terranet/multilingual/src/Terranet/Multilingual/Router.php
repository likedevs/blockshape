<?php namespace Terranet\Multilingual;


use Closure;
use Illuminate\Routing\Router as IlluminateRouter;
use Lang;

class Router extends IlluminateRouter
{

    public function multilingual($attributes, Closure $callback = null)
    {
        if ($attributes instanceof Closure)
        {
            /**
             * Register both groups: with language in url segment and that without it
             */
            $this->group([], $attributes);
            if (($lang = Lang::slug()) != config('app.default_locale')) {
                $this->group(['prefix' => $lang], $attributes);
            }
        }
        elseif (is_array($attributes))
        {
            $slug = Lang::slug();

            $prefix = isset($attributes['prefix'])
                ? ($slug . '/' . $attributes['prefix'])
                : $slug;

            /**
             * Register both groups: with language in url segment and that without it
             */
            $this->group($attributes, $callback);
            if ($slug = trim($prefix, '/')) {
                $this->group(array_merge($attributes, ['prefix' => $slug]), $callback);
            }

        }
        else
        {
            throw new \InvalidArgumentException('First argument must be of type Closure or array');
        }
    }
}