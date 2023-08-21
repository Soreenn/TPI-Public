<?php

namespace Controllers;

session_start();

use Models\User;

class Controller
{
    public function __construct()
    {
        if (isset($_SESSION['email'])) {
            $userModel = new User();
            $users = $userModel->getSpecificUserByEmail($_SESSION['email']);

            $path = $_SERVER['REQUEST_URI'];
            $path = explode('?', $_SERVER['REQUEST_URI'])[0];

            $this->CreateSessions($users);
            $this->EmailVerification($users, $path);
        }
    }

    private function CreateSessions(array $users)
    {
        $_SESSION['admin'] = $users[0]->administrator;
        $_SESSION['confirmed'] = $users[0]->confirmed;
        $_SESSION['blocked'] = $users[0]->blocked;
    }

    private function EmailVerification(array $users, string $path)
    {
        if ($users[0]->confirmed == 0 && $path != "/verifyEmail" && $path != "/verify") {
            header("Location: /verifyEmail");
        }
    }

    public function IsUserConfirmed() : bool
    {
        $userModel = new User();
        $path = $_SERVER['REQUEST_URI'];
        $path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $users = $userModel->getSpecificUserByEmail($_SESSION['email']);
        if ($users[0]->confirmed == 0 && $path != "/verifyEmail" && $path != "/verify") {
            return false;
        }
        return true;
    }
}
