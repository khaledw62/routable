<?php


namespace Echosters\Routable\Facades;


class RoutableFacade
{
    public static function __callStatic($method, $args)
    {
        return (new self)::resolveFacade('RoutableFacade')->$method(...$args);
    }

    public static function resolveFacade($name)
    {
        return app()->make($name);
    }
}
