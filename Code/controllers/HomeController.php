<?php

namespace Controllers;

use Models\Category;
use Models\Subject;
use Models\User;
use Models\Post;
use Source\Renderer;

class HomeController extends Controller
{
    public function show()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->all();

        $subjectModel = new Subject();
        $subjects = $subjectModel->GetUserVisibleSubjects();
        

        $userModel = new User();

        $postModel = new Post();

        $renderer = new Renderer('home', compact('categories', 'subjects', 'userModel', 'postModel'));
        return $renderer->view();
    }
}