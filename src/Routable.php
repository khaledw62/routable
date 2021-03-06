<?php

namespace Echosters\Routable;
use Echosters\Routable\Facades\RoutableFacade;
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
        $routes = [];
        $routeName = RoutableFacade::getModelRouteName($this);

        //All Possible Routes to this model this,So we'll Iterate over all possible route to deal with each separately
        foreach (RoutableFacade::getAllRoutes() as $routeIndex) {
            //Default Route Setting
            $params = [];
            //Check if Desired Route is Bindable,if So ,We'll pass the id
            if (RoutableFacade::isBindableRoute($routeIndex)) {
                $params = [$this->getRouteKeyName()];
            }

            //add fixed params to the parameters if exist
            $fixedParameters = RoutableFacade::hasFixedParameter($this);

            //Merge Fixed Parameters
            $parameters = array_merge($fixedParameters,$parameters);

            //Check if there are additional parameters to be passed
            $params = array_merge($params,$parameters);

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
