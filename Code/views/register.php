<?php
ob_start();
?>

<div class="hero min-h-screen">
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
        <div class="card-body">
            <form action="/registerUser" method="POST" enctype="multipart/form-data"">
                <div class=" form-control">
                <h1 class="text-3xl font-bold text-center mb-10">Inscription</h1>
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input required type="email" name="email" placeholder="email" class="input input-bordered" />
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Nom d'utilisateur</span>
            </label>
            <input maxlength="20" required name="username" type="text" placeholder="nom d'utilisateur" class="input input-bordered" />
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Mot de passe</span>
            </label>
            <input required name="password" type="password" placeholder="mot de passe" class="input input-bordered" />
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Confirmation mot de passe</span>
            </label>
            <input required name="passwordConfirm" type="password" placeholder="confirmation mot de passe" class="input input-bordered" />
        </div>
        <input name="file" type="file" accept=".png,.jpg,.jpeg" class="mt-4 file-input file-input-bordered file-input-success w-full max-w-xs" />
        <small>Seulement les fichiers : jpeg, png jpg.</small>
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
        <div class="form-control mt-6">
            <button class="btn btn-primary">S'inscrire</button>
            <label class="label">
                <span class="label-text-alt">Déjà inscrit ? <a href="/login" class="link link-hover">Se connecter</a></span>
            </label>
        </div>
        </form>
    </div>
</div>
</div>
</div>

<?php
$content = ob_get_clean();
require "template.php";
?>