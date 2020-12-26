<?php


namespace Echosters\Routable;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RouteHelper
{
    public function getModelRouteName(Model $model)
    {
        $routeName = Str::lower(Str::plural(class_basename($model)));

        if (method_exists($this,'getRouteName')) {
            $routeName = $this->getRouteName();
        }

        return $routeName;
    }

    /**
     * check if the chosen route is bindable
     * @param string $route
     * @return boolean
     */
    public function isBindableRoute(string $route)
    {
        return in_array($route,['edit','show','update','destroy']);
    }
}
