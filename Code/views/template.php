<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use Models\User;
?>

<!DOCTYPE html>
<html lang="fr" data-theme="light" class="bg-slate-200 scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doc</title>
    <link href="./css/output.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
    <div class="navbar bg-white text-black">
        <div class="navbar-start">
            <a href="/" class="btn btn-ghost normal-case text-xl"><img class="w-9 mr-4" src="https://i.ibb.co/k5kggcT/Logo.png" />Yotsuba</a>
            <div class="navbar-center flex">
                <ul class="menu menu-horizontal px-1">
                    <li tabindex="0">
                        <a>
                            Catégories
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                            </svg>
                        </a>
                        <ul class="absolute bg-white">
                            <?php foreach ($categories as $category) : ?>
                                <li><a href="category?categoryId=<?= $category->id ?>"><img class='w-5' src='<?= $category->icone ?>'><?= htmlentities($category->name, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></a></li>
                            <?php endforeach; ?>
                            <?php if (isset($_SESSION['email'])) : ?>
                                <li><a href="/subscriptions"><img class='w-5' src='https://www.iconarchive.com/download/i82801/succodesign/love-is-in-the-web/heart.ico'>Abonnés</a></li>
                                <li><a href="/newCategory"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>Nouvelle categorie</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="navbar-end">
            <?php if (isset($_SESSION['username'])) : ?>
                <?php if (!$_SESSION['blocked']) : ?>
                    <a href="/createSubjectForm"><button class="btn btn-ghost btn-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <div class="dropdown dropdown-end ml-3">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <?php if (isset($_SESSION['username'])) : ?>
                            <img src="<?= $_SESSION['picture'] ?>" />
                        <?php else : ?>
                            <img src="https://t3.ftcdn.net/jpg/05/00/54/28/360_F_500542898_LpYSy4RGAi95aDim3TLtSgCNUxNlOlcM.jpg" />
                        <?php endif; ?>
                    </div>
                </label>
                <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-white rounded-box w-52">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <li><a href="/profile?userId=<?= ((new User())->getSpecificUserByUsername($_SESSION['username']))[0]->id ?>">Profile</a></li>
                        <li><a href="/logout">Se déconnecter</a></li>
                    <?php else : ?>
                        <li><a href="/login">Se connecter</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php if (isset($_SESSION['username'])) : ?>
                <div class="ml-3"><?= htmlentities($_SESSION['username'], ENT_QUOTES | ENT_HTML5, 'UTF-8') ?></div>
            <?php else : ?>
                <div class="ml-3">Guest</div>
            <?php endif; ?>
        </div>
    </div>
    <?= $content ?>
</body>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const buttonCloseReply = document.getElementById('closeReply');
        const buttonSend = document.getElementById('send');

        $("button").click(function() {
            if ($(this).hasClass('reply')) {
                document.getElementById("createPost").classList.remove("hidden");

                document.getElementById('replyTo').innerHTML = "Réponds à : " + $(this).val();
                buttonSend.value = $(this).val();
                window.scrollTo(0, document.body.scrollHeight);
            }
        });

        $('.image').click(function(evt) {
            if ($(this).hasClass('w-52')) {
                $(this).removeClass('w-52')
                $(this).addClass("w-96");
            } else {
                $(this).removeClass('w-96')
                $(this).addClass("w-52");
            }
        });

        buttonCloseReply.addEventListener("click", function() {
            document.getElementById("createPost").classList.add("hidden");
        });
    });
</script>

</html>