<?php

namespace Source;

class Renderer
{
    public function __construct(private string $viewPath, private ?array $params)
    {
    }

    public function view()
    {
        extract($this->params);
        require Constant::Base_View_Path . $this->viewPath . '.php';
    }
}
