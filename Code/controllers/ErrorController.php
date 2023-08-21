<?php

namespace Controllers;

use Models\Category;
use Source\Renderer;

class ErrorController extends Controller
{
    public function notFound()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->all();

        $renderer = new Renderer('lost', compact('categories'));
        return $renderer->view();
    }

    public function verifyEmail()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->all();

        $renderer = new Renderer('verifyEmail', compact('categories'));
        return $renderer->view();
    }
}