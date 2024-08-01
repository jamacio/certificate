<?php

namespace App\Resolvers;

use ReflectionClass;
use ReflectionMethod;

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

        foreach ($parameters as $index => $parameter) {
            if (isset($params[$index])) {
                $resolved[] = $params[$index];
            } elseif ($parameter->getType() && !$parameter->getType()->isBuiltin()) {
                $resolved[] = app($parameter->getType()->getName());
            } else {
                $resolved[] = null;
            }
        }

        return $resolved;
    }
}
