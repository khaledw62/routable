<?php


namespace Echosters\Routable\Facades;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
/**
 * @method static getModelRouteName(Model $model)
 * @method static isBindableRoute(string $route)
 * @method static hasFixedParameter(Model $model)
 * @method static getAllRoutes()
 *
 * @see \Echosters\Routable\RouteHelper
 */
class RoutableFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'routable';
    }
}
