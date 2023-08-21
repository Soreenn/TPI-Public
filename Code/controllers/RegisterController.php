<?php

namespace Controllers;

use Models\Category;
use Models\User;
use Source\Renderer;

class RegisterController extends Controller
{
    public function show()
    {
        if (!isset($_SESSION['username'])) {
            $categoryModel = new Category();
            $categories = $categoryModel->all();
            $errorMessage = $_GET['errorMessage'] ?? null;
            $renderer = new Renderer('register', compact('categories', 'errorMessage'));
            return $renderer->view();
        }
    }

    public function register()
    {
        if (!isset($_SESSION['username'])) {
            $registerForm = $_POST;

            if ($registerForm['email'] != "" && $registerForm['username'] != "" && $registerForm['password'] != "" && $registerForm['passwordConfirm'] != "") {
                if (filter_var($registerForm['email'], FILTER_VALIDATE_EMAIL)) {
                    $userModel = new User();
                    $users = $userModel->getSpecificUserByEmail($registerForm['email']);
                    if (count($users) == 0) {
                        $users = $userModel->getSpecificUserByUsername(substr($registerForm['username'], 0, 20));
                        if (count($users) == 0) {
                            if ($registerForm['password'] == $registerForm['passwordConfirm']) {
                                $file_name = $_FILES['file']['name'];
                                $file_tmp = $_FILES['file']['tmp_name'];
                                $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                                if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
                                    $path = "./uploads/profile_pictures/" . date("d-m-y-H-i-s") . "." . $extension;
                                    move_uploaded_file($file_tmp, $path);
                                    $bytes = random_bytes(10);
                                    $token = bin2hex($bytes);
                                    $users = $userModel->GetSpecificUserByToken($token);
                                    while (count($users) != 0) {
                                        $bytes = random_bytes(10);
                                        $token = bin2hex($bytes);
                                    }
                                    $userModel->insertNewUser($registerForm['email'], substr($registerForm['username'], 0, 20), $path, password_hash($registerForm['password'], PASSWORD_DEFAULT), 0, 0, $token, 0, date("Y/m/d"));
                                    if (session_start()) {
                                        $_SESSION['email'] = $registerForm['email'];
                                        $_SESSION['username'] = substr($registerForm['username'], 0, 20);
                                        $_SESSION['picture'] = $path;
                                    }
                                    $this->sendVerifyEmail();
                                    header("Location: /");
                                } else {
                                    header("Location: /register?errorMessage=Format d'image incorrect");
                                }
                            } else {
                                header("Location: /register?errorMessage=Les mot de passe ne correspondent pas");
                            }
                        } else {
                            header("Location: /register?errorMessage=Nom d'utilisateur non disponible");
                        }
                    } else {
                        header("Location: /register?errorMessage=Email déjà utilisée");
                    }
                } else {
                    header("Location: /register?errorMessage=Email invalide");
                }
            } else {
                header("Location: /register?errorMessage=Formulaire incomplet");
            }
        }
    }

    public function sendVerifyEmail()
    {
        $userModel = new User();
        $user = $userModel->getSpecificUserByUsername($_SESSION['username']);
        if ($user[0]->confirmed == 0) {
            $mailController = new MailController();
            $subject = "Activation du compte - Yotsuba";
            $body = "Confirmez votre email pour activer votre compte : http://10.229.33.240:8888/verify?token=" . $user[0]->token;
            $mailController->send($subject, $body);
        }
    }

    public function verifyEmailToken()
    {
        $token = $_GET['token'] ?? null;

        $userModel = new User();
        $user = $userModel->getSpecificUserByUsername($_SESSION['username']);
        if ($user[0]->confirmed == 0) {
            if ($token == $user[0]->token) {
                $userModel->verifyEmail($user[0]->username);
                header("Location: /");
            }
        }
    }
}
