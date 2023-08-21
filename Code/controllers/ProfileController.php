<?php

namespace Controllers;

use Models\Category;
use Models\User;
use Source\Renderer;

class ProfileController extends Controller
{
    public function show()
    {
        $userId = $_GET['userId'] ?? null;

        $categoryModel = new Category();
        $categories = $categoryModel->all();

        $usermodel = new User();
        $user = ($usermodel->GetSpecificUserById($userId))[0];

        $renderer = new Renderer('profile', compact('categories', 'user'));
        return $renderer->view();
    }

    public function verifyEmail()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->all();

        $renderer = new Renderer('verifyEmail', compact('categories'));
        return $renderer->view();
    }

    public function changePassword()
    {
        if (isset($_SESSION['username'])) {
            $usermodel = new User();
            $user = ($usermodel->GetSpecificUserByUsername($_SESSION['username']))[0];

            if ($_POST['password'] != "") {
                $password = $_POST['password'];

                $usermodel->changePassword($user->id, password_hash($password, PASSWORD_DEFAULT));

                header('Location: /profile?userId=' . $user->id);
            } else {
                header('Location: /profile?userId=' . $user->id);
            }
        }
    }

    public function changeUsername()
    {
        if (isset($_SESSION['username'])) {
            $usermodel = new User();
            $user = ($usermodel->GetSpecificUserByUsername($_SESSION['username']))[0];
            if ($_POST['username'] != "") {
                $username = $_POST['username'];
                if (count(($usermodel->GetSpecificUserByUsername($username))) == 0) {
                    $usermodel->changeUsername($user->id, substr($username, 0, 20));
                    $_SESSION['username'] = $username;
                }

                header('Location: /profile?userId=' . $user->id);
            } else {
                header('Location: /profile?userId=' . $user->id);
            }
        }
    }

    public function blockUser()
    {
        if (isset($_SESSION['username'])) {
            if ($_SESSION['admin'] == 1) {
                $userId = $_GET['userId'] ?? null;
                $userModel = new User();
                $userModel->blockUser($userId);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                header('Location: /home');
            }
        }
    }
}
