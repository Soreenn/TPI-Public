<?php

use Models\Post;
use Models\User;
use Models\UserReplyPost;

ob_start();
?>

<div class="justify-center h-screen">
    <div class="overflow-x-auto">
        <?php foreach ($subjects as $subject) : ?>
            <?php if ((new User)->GetSpecificUserById($subject->User_id)[0]->blocked == 0) : ?>
                <div class="mx-auto grid max-w-4xl grid-cols-12 gap-4 p-6">
                    <div class="header col-span-12">
                        <table class="w-full text-black table table-fixed">
                            <thead>
                                <tr>
                                    <th class="text-left"><a href="/subject?subjectId=<?= $subject->id ?>"><?= htmlentities(substr($subject->title, 0, 30), ENT_QUOTES | ENT_HTML5, 'UTF-8') . "..." ?></a></th>
                                    <th class="text-center"><?= ($userModel->GetSpecificUserById($subject->User_id))[0]->username ?> | <?= $subject->creationdate ?> | <?= (new DateTime($subject->creationdate))->diff(new DateTime(date("Y/m/d")))->days; ?> jours</th>
                                    <th class="text-right"><?= count((new Post)->getMostRecentPostBySubjectId($subject->id)) ?> réponses</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <?php if (count((new Post)->getMostRecentPostBySubjectId($subject->id)) > 0) : ?>
                        <div class="col-span-12 rounded-lg bg-white p-8 sm:col-span-4 text-center font-bold">
                            <img class="w-96 mb-2" src="<?= (new User())->GetSpecificUserById((new UserReplyPost())->getUserIdByPostId((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->id)[0]->User_id)[0]->picture ?>" />
                            <a href="profile?userId=<?= (new User())->GetSpecificUserById((new UserReplyPost())->getUserIdByPostId((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->id)[0]->User_id)[0]->id ?>"><?= htmlentities((new User())->GetSpecificUserById((new UserReplyPost())->getUserIdByPostId((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->id)[0]->User_id)[0]->username, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></a>
                            <p>Rejoins le : <?= (new User())->GetSpecificUserById((new UserReplyPost())->getUserIdByPostId((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->id)[0]->User_id)[0]->creationdate ?></p>
                        </div>
                        <div class="col-span-12 rounded-lg bg-white sm:col-span-8 text-center">
                            <table class="w-full text-black table table-fixed mb-6">
                                <thead>
                                    <tr>
                                        <th class="text-left"><?= (new Post)->getMostRecentPostBySubjectId($subject->id)[0]->creationdate ?> | <?= (new DateTime((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->creationdate))->diff(new DateTime(date("Y/m/d")))->days; ?> jours</th>
                                        <th class="text-right">Réponds à <?= htmlentities((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->replyingto, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></th>
                                    </tr>
                                </thead>
                            </table>
                            <p class="text-left p-4"><?= htmlentities((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->description, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></p>
                            <?php if (substr(htmlentities((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->media), -4) == ".png" || substr(htmlentities((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->media), -4) == ".jpg" || substr(htmlentities((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->media), -5) == ".jpeg" || substr(htmlentities((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->media), -4) == ".gif") : ?>
                                <img class="w-52 image mx-auto" src="<?= htmlentities((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->media) ?>">
                            <?php else : ?>
                                <video class="w-96 mx-auto" controls>
                                    <source src="<?= htmlentities((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->media) ?>" type="video/<?= substr(htmlentities((new Post)->getMostRecentPostBySubjectId($subject->id)[0]->media), -3) ?>" class="w-96 mx-auto">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <div class="col-span-12 rounded-lg bg-white p-8 sm:col-span-4 text-center font-bold">
                            <img class="w-96 mb-2" src="<?= (new User())->GetSpecificUserById($subject->User_id)[0]->picture ?>" />
                            <a href="profile?userId=<? (new User())->GetSpecificUserById($subject->User_id)[0]->id ?>"><?= htmlentities((new User())->GetSpecificUserById($subject->User_id)[0]->username, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></a>
                            <p>Rejoins le : <?= (new User())->GetSpecificUserById($subject->User_id)[0]->creationdate ?></p>
                        </div>
                        <div class="col-span-12 rounded-lg bg-white sm:col-span-8 text-center">
                            <table class="w-full text-black table table-fixed mb-6">
                                <thead>
                                    <tr>
                                        <th class="text-left"><?= $subject->creationdate ?> | <?= (new DateTime($subject->creationdate))->diff(new DateTime(date("Y/m/d")))->days; ?> jours</th>
                                        <th class="text-right">Post original</th>
                                    </tr>
                                </thead>
                            </table>
                            <p class="text-left p-4"><?= htmlentities($subject->description, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></p>
                            <?php if (substr($subject->media, -4) == ".png" || substr($subject->media, -4) == ".jpg" || substr($subject->media, -5) == ".jpeg" || substr($subject->media, -4) == ".gif") : ?>
                                <img class="w-52 image mx-auto" src="<?= $subject->media ?>">
                            <?php else : ?>
                                <video class="w-96 mx-auto" controls>
                                    <source src="<?= $subject->media ?>" type="video/<?= substr($subject->media, -3) ?>" class="w-96 mx-auto">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>


<?php
$content = ob_get_clean();
require "template.php";
?>