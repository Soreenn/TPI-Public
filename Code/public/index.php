<?php
header_remove();

use Router\Router;
use Source\App;

require '../vendor/autoload.php';

$router = new Router();

$router->register('/', ['Controllers\HomeController', 'show']);
$router->register('/home', ['Controllers\HomeController', 'show']);

$router->register('/login', ['Controllers\LoginController', 'show']);
$router->register('/auth', ['Controllers\LoginController', 'auth']);
$router->register('/logout', ['Controllers\LoginController', 'logout']);

$router->register('/register', ['Controllers\RegisterController', 'show']);
$router->register('/registerUser', ['Controllers\RegisterController', 'register']);

$router->register('/createSubjectForm', ['Controllers\SubjectController', 'createSubjectForm']);
$router->register('/createSubject', ['Controllers\SubjectController', 'createSubject']);

$router->register('/subject', ['Controllers\SubjectController', 'show']);

$router->register('/createPost', ['Controllers\PostController', 'createPost']);
$router->register('/blockPost', ['Controllers\PostController', 'blockPost']);

$router->register('/category', ['Controllers\CategoryController', 'show']);
$router->register('/newCategory', ['Controllers\CategoryController', 'newCategory']);
$router->register('/createCategory', ['Controllers\CategoryController', 'createCategory']);

$router->register('/subscriptions', ['Controllers\SubscribeController', 'show']);
$router->register('/subscribe', ['Controllers\SubscribeController', 'subscribe']);

$router->register('/verifyEmail', ['Controllers\ErrorController', 'verifyEmail']);
$router->register('/sendVerifyEmail', ['Controllers\RegisterController', 'sendVerifyEmail']);
$router->register('/verify', ['Controllers\RegisterController', 'verifyEmailToken']);

$router->register('/blockSubject', ['Controllers\SubjectController', 'blockSubject']);
$router->register('/archiveSubject', ['Controllers\SubjectController', 'archiveSubject']);

$router->register('/profile', ['Controllers\ProfileController', 'show']);
$router->register('/changePassword', ['Controllers\ProfileController', 'changePassword']);
$router->register('/changeUsername', ['Controllers\ProfileController', 'changeUsername']);
$router->register('/blockUser', ['Controllers\ProfileController', 'blockUser']);


(new App($router, $_SERVER['REQUEST_URI']))->run();