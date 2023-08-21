<?php
ob_start();
?>

<div class="hero min-h-screen">
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-white">
        <div class="card-body">
            <form action="/auth" method="POST">
                <div class="form-control">
                    <h1 class="text-3xl font-bold text-center mb-10">Connexion</h1>
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input required type="email" name="email" placeholder="email" class="input input-bordered" />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Mot de passe</span>
                    </label>
                    <input required name="password" type="password" placeholder="mot de passe" class="input input-bordered" />
                    <label class="label">
                        <a href="#" class="label-text-alt link link-hover">Forgot password ?</a>
                    </label>
                </div>
                <?php if ($errorMessage != null) : ?>
                    <div class="alert alert-error shadow-lg">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span><?= $errorMessage ?></span>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-control mt-6">
                    <button class="btn btn-primary">Se connecter</button>
                    <label class="label">
                        <span class="label-text-alt">Première fois sur Yotsuba ? <a href="/register" class="link link-hover">S'inscrire</a></span>
                    </label>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require "template.php";
?>