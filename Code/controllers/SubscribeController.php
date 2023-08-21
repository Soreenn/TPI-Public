<?php

namespace Controllers;

session_start();

use Models\Category;
use Models\Subject;
use Models\User;
use Models\Post;
use Models\UserSubscribeSubject;
use Source\Renderer;

class SubscribeController extends Controller
{
    public function show()
    {
        if (isset($_SESSION['username'])) {
            $userModel = new User();

            $categoryModel = new Category();
            $categories = $categoryModel->all();

            $subjectModel = new Subject();
            $subjects = $subjectModel->GetUserVisibleSubjects();

            $subscribeModel = new UserSubscribeSubject();
            $subscriptions = $subscribeModel->getSubjectsIdByUserId(($userModel->getSpecificUserByUsername($_SESSION['username'])[0]->id));

            $postModel = new Post();

            $renderer = new Renderer('subscriptions', compact('categories', 'subjects', 'userModel', 'postModel', 'subscriptions'));
            return $renderer->view();
        } else {
            header("Location: /home");
        }
    }

    public function subscribe()
    {
        if (isset($_SESSION['username'])) {
            $subjectId = $_GET['subjectId'] ?? null;

            $userModel = new User();

            $subjectModel = new Subject();
            $subjects = $subjectModel->all();

            $subscribeModel = new UserSubscribeSubject();

            if (count($subjectModel->GetSpecificSubjectById($_GET['subjectId'])) > 0) {
                if (count($subscribeModel->getSubjectsIdByUserIdAndSubjectId(($userModel->getSpecificUserByUsername($_SESSION['username'])[0]->id), $_GET['subjectId'])) == 0) {
                    $subscriptions = $subscribeModel->insertNewSubscription(($userModel->getSpecificUserByUsername($_SESSION['username'])[0]->id), $_GET['subjectId']);
                }
            }

            $renderer = new Renderer('subscriptions', compact('categories', 'subjects', 'userModel', 'postModel', 'subscriptions'));
            header("Location: /subject?subjectId=" . $subjectId);
        }
    }
}
