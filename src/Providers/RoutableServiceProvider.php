<?php


namespace Echosters\Routable\Providers;


use Echosters\Routable\RouteHelper;
use Illuminate\Support\ServiceProvider;

class RoutableServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('routable',function ($app) {
            return new RouteHelper();
        });
    }

    public function boot()
    {
        //
    }

}
