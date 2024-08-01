<?php

namespace App\Resolvers;

class ControllerResolver
{
    public static function resolve($controllerClass, $method, $parameters = [])
    {
        $controller = new $controllerClass();
        return call_user_func_array([$controller, $method], $parameters);
    }
}
