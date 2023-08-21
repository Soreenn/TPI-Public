<?php

namespace Router;

use Controllers\ErrorController;

class Router
{
    private array $routes;

    public function register(string $path, array $action): void
    {
        $this->routes[$path] = $action;
    }

    public function resolve(string $uri)
    {
        $path = explode('?', $uri)[0];
        $action = $this->routes[$path] ?? null;

        [$className, $methode] = $action;

        if (class_exists($className) && method_exists($className, $methode)) {
            $class = new $className();
            return call_user_func_array([$class, $methode], []);
        }
        else{
            $lost = new ErrorController();
            return call_user_func_array([$lost, 'notFound'], []);
        }
    }
}
