<?php

use Models\User;
use Models\UserReplyPost;

ob_start();
?>

<div class="justify-center h-screen">
    <div class="overflow-x-auto">
        <div class="mx-auto grid max-w-4xl grid-cols-12 gap-4 p-6">
            <div class="header col-span-12">
                <table class="w-full text-black table table-fixed">
                    <thead>
                        <tr>
                            <th class="text-left"><?= $subject[0]->creationdate ?> | <?= (new DateTime($subject[0]->creationdate))->diff(new DateTime(date("Y/m/d")))->days; ?> jours</th>
                            <th class="text-center"><?= htmlentities($subject[0]->title, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></th>
                            <th class="text-right"><?= count($posts) ?> réponses</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-span-12 rounded-lg bg-white p-8 sm:col-span-4 text-center font-bold">
                <img class="w-96 mb-2" src="<?= (new User())->GetSpecificUserById($subject[0]->User_id)[0]->picture ?>" />
                <a href="profile?userId=<?= (new User())->GetSpecificUserById($subject[0]->User_id)[0]->id ?>"><?= htmlentities((new User())->GetSpecificUserById($subject[0]->User_id)[0]->username, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></a>
                <p>Rejoins le : <?= (new User())->GetSpecificUserById($subject[0]->User_id)[0]->creationdate ?></p>
            </div>
            <div class="col-span-12 rounded-lg bg-white sm:col-span-8 text-center">
                <p class="text-left p-4"><?= htmlentities($subject[0]->description, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></p>
                <?php if (substr($subject[0]->media, -4) == ".png" || substr($subject[0]->media, -4) == ".jpg" || substr($subject[0]->media, -5) == ".jpeg" || substr($subject[0]->media, -4) == ".gif") : ?>
                    <img class="w-52 image mx-auto" src="<?= $subject[0]->media ?>">
                <?php else : ?>
                    <video class="w-96 mx-auto" controls>
                        <source src="<?= $subject[0]->media ?>" type="video/<?= substr($subject[0]->media, -3) ?>" class="w-96 mx-auto">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>
            </div>
            <?php if (isset($_SESSION['email']) && $_SESSION['admin'] == 1) : ?>
                <div class="col-span-5"></div>
                <a href="/blockSubject?subjectId=<?= $subject[0]->id ?>" class="btn btn-xs bg-red-600 col-span-2">Bloquer</a>
                <a href="/archiveSubject?subjectId=<?= $subject[0]->id ?>" class="btn btn-xs bg-green-600 col-span-2">Archiver</a>
            <?php else : ?>
                <div class="col-span-9"></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['email'])) : ?>
                <a href="/subscribe?subjectId=<?= $subject[0]->id ?>" class="btn btn-xs col-span-1 bg-transparent border-transparent hover:bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                </a>
                <button value="<?= (new User())->GetSpecificUserById($subject[0]->User_id)[0]->username ?>" class="reply btn btn-xs col-span-2">Répondre</button>
            <?php endif; ?>

        </div>

        <?php foreach ($posts as $post) : ?>
            <?php if ((new User())->GetSpecificUserById((new UserReplyPost())->getUserIdByPostId($post->id)[0]->User_id)[0]->blocked == 0 && $post->blocked == 0) : ?>
                <div class="mx-auto grid max-w-4xl grid-cols-12 gap-4 p-6">
                    <div class="col-span-12 rounded-lg bg-white p-8 sm:col-span-4 text-center font-bold">
                        <img class="w-96 mb-2" src="<?= (new User())->GetSpecificUserById((new UserReplyPost())->getUserIdByPostId($post->id)[0]->User_id)[0]->picture ?>?>" />
                        <a href="profile?userId=<?= (new User())->GetSpecificUserById((new UserReplyPost())->getUserIdByPostId($post->id)[0]->User_id)[0]->id ?>"><?= htmlentities((new User())->GetSpecificUserById((new UserReplyPost())->getUserIdByPostId($post->id)[0]->User_id)[0]->username, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></a>
                        <p>Rejoins le : <?= htmlentities((new User())->GetSpecificUserById((new UserReplyPost())->getUserIdByPostId($post->id)[0]->User_id)[0]->creationdate, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></p>
                    </div>
                    <div class="col-span-12 rounded-lg bg-white sm:col-span-8 text-center">
                        <table class="w-full text-black table table-fixed mb-6">
                            <thead>
                                <tr>
                                    <th class="text-left"><?= $post->creationdate ?> | <?= (new DateTime($post->creationdate))->diff(new DateTime(date("Y/m/d")))->days; ?> jours</th>
                                    <th class="text-right">Réponds à : <?= htmlentities($post->replyingto, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></th>
                                </tr>
                            </thead>
                        </table>
                        <div class="col-span-12 rounded-lg bg-white sm:col-span-8 text-center">
                            <p class="text-left p-4"><?= htmlentities($post->description, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></p>
                            <?php if (substr($post->media, -4) == ".png" || substr($post->media, -4) == ".jpg" || substr($post->media, -5) == ".jpeg" || substr($post->media, -4) == ".gif") : ?>
                                <img class="w-52 image mx-auto" src="<?= $post->media ?>">
                            <?php else : ?>
                                <video class="w-96 mx-auto" controls>
                                    <source src="<?= $post->media ?>" type="video/<?= substr($post->media, -3) ?>" class="w-96 mx-auto">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['email']) && $_SESSION['admin'] == 1) : ?>
                        <div class="col-span-8"></div>
                        <a href="/blockPost?postId=<?= $post->id ?>" class="btn btn-xs bg-red-600 col-span-2">Bloquer</a>
                    <?php else : ?>
                        <div class="col-span-10"></div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['email'])) : ?>
                        <button value="<?= (new User())->GetSpecificUserById((new UserReplyPost())->getUserIdByPostId($post->id)[0]->User_id)[0]->username ?>" class="reply btn btn-xs col-span-2">Répondre</button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if (isset($_SESSION['username'])) : ?>
            <div id="createPost" class="hidden text-center">
                <h1 class="text-xl font-bold text-center">Nouveau post</h1>
                <?php if ($errorMessage != null) : ?>
                    <div class="alert alert-error shadow-lg mt-4">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span><?= $errorMessage ?></span>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="mx-auto grid max-w-4xl grid-cols-12 gap-4 p-6">
                    <div class="col-span-12 rounded-lg bg-white p-8 sm:col-span-4 text-center font-bold">
                        <img class="w-96 mb-2" src="<?= (new User())->getSpecificUserByUsername($_SESSION['username'])[0]->picture ?>" />
                        <p><?= $_SESSION['username'] ?></p>
                        <p>Rejoins le : <?= (new User())->getSpecificUserByUsername($_SESSION['username'])[0]->creationdate ?></p>
                    </div>
                    <div class="col-span-12 rounded-lg bg-white sm:col-span-8 text-center">
                        <table class="w-full text-black table table-fixed mb-6">
                            <thead>
                                <tr>
                                    <th class="text-left"><?= date("Y/m/d") ?> | 0 jours</th>
                                    <th id="replyTo" class="text-right">Réponds à : </th>
                                </tr>
                            </thead>
                        </table>
                        <form action="/createPost" method="POST" enctype="multipart/form-data">
                            <textarea name="content" class="textarea w-full" rows="6" placeholder="contenu" maxlength="255"></textarea>
                            <select name="subjectId" hidden>
                                <option value="<?= $subject[0]->id ?>" selected></option>
                            </select>
                    </div>
                    <button value="<?= htmlentities((new User())->GetSpecificUserById($subject[0]->User_id)[0]->username, ENT_QUOTES | ENT_HTML5, 'UTF-8') ?>" id="send" name="reply" class="btn btn-xs flex-col-reverse col-span-2">Envoyer</button>
                    <input required name="file" type="file" accept=".png,.jpg,.jpeg,.mp4,.mov,.wav" class="file-input file-input-xs col-span-6" maxlength="255" />
                    </form>
                    <div class="col-span-3"></div>
                    <button id="closeReply" class="btn btn-xs col-span-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
require "template.php";
?>