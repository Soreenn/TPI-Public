<?php

namespace Controllers;

use Models\Category;
use Models\Subject;
use Models\User;
use Models\Post;
use Source\Renderer;

class CategoryController extends Controller
{
    public function show()
    {
        $subjectId = $_GET['categoryId'] ?? null;

        $categoryModel = new Category();
        $categories = $categoryModel->all();

        $subjectModel = new Subject();
        $subjects = $subjectModel->GetSubjectByCategoryId($subjectId = $_GET['categoryId']);

        $userModel = new User();

        $postModel = new Post();

        $renderer = new Renderer('home', compact('categories', 'subjects', 'userModel', 'postModel'));
        return $renderer->view();
    }

    public function newCategory()
    {
        if (isset($_SESSION['username'])) {
            $errorMessage = $_GET['errorMessage'] ?? null;
            if ($_SESSION['admin'] == 1) {
                $categoryModel = new Category();
                $categories = $categoryModel->all();

                $renderer = new Renderer('createCategory', compact('categories', 'errorMessage'));
                return $renderer->view();
            }
        }
    }

    public function createCategory()
    {
        if (isset($_SESSION['username'])) {
            if (isset($_SESSION['admin']) == 1) {
                $categoryForm = $_POST;
                if ($categoryForm['title'] != "") {
                    $file_tmp = $_FILES['file']['tmp_name'];
                    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
                        $path = "./uploads/categories_media/" . date("d-m-y-H-i-s") . "." . $extension;
                        move_uploaded_file($file_tmp, "./uploads/categories_media/" . date("d-m-y-H-i-s") . "." . $extension);
                        $categoryModel = new Category();
                        $category = $categoryModel->getSpecificCategoryByName($categoryForm['title']);
                        if (count($category) == 0) {
                            $categoryModel->insertNewCategory(substr($categoryForm['title'], 0, 15), $path);
                        }
                        header("Location: /");
                    } else {
                        header("Location: /newCategory?errorMessage=Format d'image incorrect");
                    }
                }
            }
        }
    }
}
