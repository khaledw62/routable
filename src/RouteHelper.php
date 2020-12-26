<?php


namespace Echosters\Routable;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RouteHelper
{
    public function getModelRouteName(Model $model)
    {
        $routeName = Str::lower(Str::plural(class_basename($model)));

        if (method_exists($model,'getRouteName')) {
            $routeName = $model->getRouteName();
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

    /**
     * check if the the model has fixed parameter to be sent
     * @param Model $model
     * @return array
     */
    public function hasFixedParameter(Model $model)
    {
        if (method_exists($model,'getFixedParameter')) {
            return is_array($model->getFixedParameter()) ? $model->getFixedParameter() : [];
        }
        return [];
    }
}
