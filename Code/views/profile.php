<?php
ob_start();
?>

<div class="hero min-h-screen">
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-white">
        <div class="card-body">
            <div class="avatar text-center mx-auto">
                <div class="w-54 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                    <img src="<?= $user->picture ?>" />
                </div>
            </div>
            <h1 class="text-6xl text-center mt-3 font-bold mx-auto"><?= $user->username ?></h1>
            <?php if ($_SESSION['admin'] == 1) : ?>
                <?php if ($user->blocked == 1) : ?>
                    <h1 class="text-2xl text-center mt-3 font-bold mx-auto text-red-600">Blocked</h1>
                <?php else : ?>
                    <a href="/blockUser?userId=<?= $user->id ?>" class="btn btn-xs bg-red-600 col-span-2 mt-5 mb-5">Bloquer</a>
                <?php endif; ?>

            <?php endif; ?>
            <?php if (isset($_SESSION['username'])) : ?>
                <?php if ($user->username == $_SESSION['username']) : ?>
                    <form method="POST" action="/changePassword">
                        <div class="form-control">
                            <input required name="password" type="password" placeholder="mot de passe" class="input input-bordered mb-2" />
                            <button class="btn btn-primary">Changer de mot de passe</button>
                        </div>
                    </form>
                    <form method="POST" action="/changeUsername">
                        <div class="form-control">
                            <input maxlength="20" required name="username" placeholder="nom d'utilisateur" class="input input-bordered mt-5 mb-2" />
                            <button class="btn btn-primary">Changer de nom d'utilisateur</button>
                        </div>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require "template.php";
?>