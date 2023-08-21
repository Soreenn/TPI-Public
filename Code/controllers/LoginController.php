<?php

namespace Controllers;

use Models\Category;
use Models\User;
use Source\Renderer;

class LoginController extends Controller
{
    public function show()
    {
        if (!isset($_SESSION['username'])) {
            $categoryModel = new Category();
            $categories = $categoryModel->all();
            $errorMessage = $_GET['errorMessage'] ?? null;
            $renderer = new Renderer('login', compact('categories', 'errorMessage'));
            return $renderer->view();
        }
    }

    public function auth()
    {
        $loginForm = $_POST;

        if (!isset($_SESSION['username'])) {
            if ($loginForm['email'] != "" && $loginForm['password'] != "") {
                $userModel = new User();
                $users = $userModel->getSpecificUserByEmail($loginForm['email']);
                if (filter_var($loginForm['email'], FILTER_VALIDATE_EMAIL)) {
                    if (count($users) == 1) {
                        if (password_verify($loginForm['password'], $users[0]->password)) {
                            $this->CreateSessions($users);
                            header("Location: /");
                        } else {
                            header("Location: /login?errorMessage=Mot de passe incorrect");
                        }
                    } else {
                        header("Location: /login?errorMessage=Compte inexistant");
                    }
                } else {
                    header("Location: /login?errorMessage=Email invalide");
                }
            } else {
                header("Location: /login?errorMessage=Formulaire incomplet");
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['username'])) {
            if (session_start()) {
                $_SESSION = array();
                session_destroy();
                header("Location: /");
            }
        }
    }

    private function CreateSessions(array $users)
    {
        if (session_start()) {
            $_SESSION['email'] = $users[0]->email;
            $_SESSION['username'] = $users[0]->username;
            $_SESSION['picture'] = $users[0]->picture;
        }
    }
}
