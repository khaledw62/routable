<?php

namespace Echosters\Router;
use Echosters\Router\Facades\RoutableFacade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait Routable {

    /**
     * Get Routes Assigned to this Model
     * @param string $route
     * @param array $parameters
     * @return mixed
    */
    public function getRoutes($route = '' , $parameters = [])
    {
        $routeName = RoutableFacade::getModelRouteName($this);
        //Default Route Setting
        $params = [];
        //All Possible Routes to this model this,So we'll Iterate over all possible route to deal with each separately
        foreach (['edit','update','show','destroy','store'] as $routeIndex) {
            //Check if Desired Route is Bindable,if So ,We'll pass the id
            $params = [$this->id];

            //Check if there are additional parameters to be passed
            if (count($parameters) > 0) {
                $params = array_merge([$this->id],$parameters);

            }
            //Generate the route then push it to the routes array
            if (Route::has($generatedRouteName = $routeName . '.' . $routeIndex)) {
                $routes[$routeIndex] = route($generatedRouteName ,$params);
            }
        }

        return isset($routes[$route])
            ? $routes[$route]
            : $routes;
    }

    /**
     * this is an allies for getRoutes
     * @param string $route
     * @param array $parameters
     * @return mixed
    */
    public function getRoute($route = '',$parameters = [])
    {
        return $this->getRoutes($route , $parameters);
    }

    /**
     * get the un-bindable route as static function
     * @param string $route
     * @param array $parameters
     * @return mixed
    */
    public static function getResourceRoute($route = '' , $parameters = [])
    {
        $routeName = RoutableFacade::getModelRouteName(new self());
        //Generate the route then push it to the routes array
        if (Route::has($generatedRouteName = $routeName . '.' . $route)) {
            $routes[$route] = route($generatedRouteName ,$parameters);
        }
        return isset($routes[$route])
            ? $routes[$route]
            : $routes;
    }
}
?>
