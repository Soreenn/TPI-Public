<?php

namespace Controllers;

use Models\Category;
use Models\Post;
use Models\Subject;
use Models\User;
use Source\Renderer;

session_start();

class SubjectController extends Controller
{
    public function show()
    {
        $errorMessage = $_GET['errorMessage'] ?? null;

        $subjectId = $_GET['subjectId'] ?? null;

        $categoryModel = new Category();
        $categories = $categoryModel->all();

        $subjectModel = new Subject();
        $subject = $subjectModel->GetSpecificSubjectById($subjectId);

        $postModel = new Post();
        $posts = $postModel->getSpecificPostBySubjectId($_GET['subjectId']);

        $renderer = new Renderer('subject', compact('categories', 'subject', 'posts', 'errorMessage'));
        return $renderer->view();
    }

    public function createSubjectForm()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->all();
        $errorMessage = $_GET['errorMessage'] ?? null;
        $renderer = new Renderer('createSubject', compact('categories', 'errorMessage'));
        return $renderer->view();
    }

    public function createSubject()
    {
        if (isset($_SESSION['username'])) {
            $subjectForm = $_POST;
            if ($subjectForm['title'] != "" && $subjectForm['category'] != "" && $subjectForm['content'] != "") {
                $file_name = $_FILES['file']['name'];
                $file_tmp = $_FILES['file']['tmp_name'];
                $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'mov' || $extension == 'wav' || $extension == 'mp4' || $extension == 'gif') {
                    if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif') {
                        $path = "./uploads/subjects_media/img/" . date("d-m-y-H-i-s") . "." . $extension;
                        move_uploaded_file($file_tmp, "./uploads/subjects_media/img/" . date("d-m-y-H-i-s") . "." . $extension);
                    } else {
                        $path = "./uploads/subjects_media/videos/" . date("d-m-y-H-i-s") . "." . $extension;
                        move_uploaded_file($file_tmp, "./uploads/subjects_media/videos/" . date("d-m-y-H-i-s") . "." . $extension);
                    }
                    $categoryModel = new Category();
                    $category = $categoryModel->getSpecificCategoryByName($subjectForm['category']);
                    $userModel = new User();
                    $user = $userModel->getSpecificUserByUsername($_SESSION['username']);
                    $subjectModel = new Subject();
                    $subjectModel->insertNewSubject(substr($subjectForm['content'], 0, 255), date("Y/m/d"), $path, substr($subjectForm['title'], 0, 100), 0, 0, $category[0]->id, $user[0]->id, date('Y/m/d H:i:s'));
                    header("Location: /");
                } else {
                    header("Location: /createSubjectForm?errorMessage=Format d'image incorrect");
                }
            }
        }
    }

    public function blockSubject()
    {
        if (isset($_SESSION['username'])) {
            if ($_SESSION['admin'] == 1) {
                $subjectId = $_GET['subjectId'] ?? null;
                $subjectModel = new Subject();
                $subjectModel->BlockSubject($subjectId);
                header('Location: /home');
            } else {
                header('Location: /home');
            }
        }
    }

    public function archiveSubject()
    {
        if (isset($_SESSION['username'])) {
            if ($_SESSION['admin'] == 1) {
                $subjectId = $_GET['subjectId'] ?? null;
                $subjectModel = new Subject();
                $subjectModel->archiveSubject($subjectId);
                header('Location: /home');
            } else {
                header('Location: /home');
            }
        }
    }
}
