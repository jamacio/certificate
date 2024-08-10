<?php

namespace App\Resolvers;

use ReflectionClass;
use ReflectionMethod;
use Illuminate\Http\Request;

class ControllerResolver
{
    public static function resolve($controller, $method, $params = [])
    {
        $reflector = new ReflectionClass($controller);
        $instance = $reflector->newInstance();

        if (!$reflector->hasMethod($method)) {
            throw new \Exception("Method {$method} not found in controller {$controller}");
        }

        $reflectMethod = $reflector->getMethod($method);

        $params = self::resolveParameters($reflectMethod, $params);

        return $reflectMethod->invokeArgs($instance, $params);
    }

    private static function resolveParameters(ReflectionMethod $method, $params)
    {
        $parameters = $method->getParameters();
        $resolved = [];
        $requestProvided = false;

        foreach ($parameters as $index => $parameter) {
            if ($parameter->getType() && $parameter->getType()->getName() === Request::class) {
                $resolved[] = Request::createFromGlobals();
                $requestProvided = true;
            } elseif (isset($params[$index])) {
                $resolved[] = $params[$index];
            } elseif ($parameter->getType() && !$parameter->getType()->isBuiltin()) {
                $resolved[] = app($parameter->getType()->getName());
            } else {
                $resolved[] = null;
            }
        }

        if (!$requestProvided && !empty($parameters)) {
            array_unshift($resolved, Request::createFromGlobals());
        }

        return $resolved;
    }
}
