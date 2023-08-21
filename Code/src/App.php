<?php

namespace Source;

use Router\Router;

class App
{
    public function __construct(private Router $router, private string $requestUri)
    {
        
    }

    public function run(){
        $this->router->resolve($_SERVER['REQUEST_URI']);
    }
}