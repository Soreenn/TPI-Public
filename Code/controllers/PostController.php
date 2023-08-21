<?php

namespace Controllers;

session_start();

use Models\Post;
use Models\Subject;
use Models\User;
use Models\UserReplyPost;

class PostController extends Controller
{
    public function createPost()
    {
        $postForm = $_POST;
        if (isset($_SESSION['username'])) {
            if ($postForm['content'] != "") {
                if (!file_exists($_FILES['file']['name']) || !is_uploaded_file($_FILES['file']['name'])) {
                    $file_name = $_FILES['file']['name'];
                    $file_tmp = $_FILES['file']['tmp_name'];
                    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                    if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'mov' || $extension == 'wav' || $extension == 'mp4' || $extension == 'gif') {
                        if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif') {
                            $path = "./uploads/posts_media/img/" . date("d-m-y-H-i-s") . "." . $extension;
                            move_uploaded_file($file_tmp, "./uploads/posts_media/img/" . date("d-m-y-H-i-s") . "." . $extension);
                        } else {
                            $path = "./uploads/posts_media/videos/" . date("d-m-y-H-i-s") . "." . $extension;
                            move_uploaded_file($file_tmp, "./uploads/posts_media/videos/" . date("d-m-y-H-i-s") . "." . $extension);
                        }
                        $userModel = new User();
                        $user = $userModel->getSpecificUserByUsername($postForm['reply']);
                        $postModel = new Post();
                        $postModel->insertNewPost(substr($postForm['content'], 0, 1000), date("Y/m/d"), $path, 0, $postForm['subjectId'], $user[0]->username);
                        $subjectModel = new Subject();
                        $subjectModel->updateTimestamp(date('Y/m/d H:i:s'), $postForm['subjectId']);
                        $user = $userModel->getSpecificUserByUsername($_SESSION['username']);
                        $userReplyPostModel = new UserReplyPost();
                        $postsCount = count($postModel->all());
                        $userReplyPostModel->insertNewPostReply($user[0]->id, $postsCount);
                        header("Location: /subject?subjectId=" . $postForm['subjectId']);
                    } else {
                        header("Location: /subject?errorMessage=Format d'image incorrect&subjectId=" .$_POST['subjectId']);
                    }
                }
            }
        }
    }

    public function blockPost()
    {
        if (isset($_SESSION['username'])) {
            if ($_SESSION['admin'] == 1) {
                $postId = $_GET['postId'] ?? null;

                $postModel = new Post();
                $postModel->blockPost((new Post)->getSpecificPostById($postId)[0]->id);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}
