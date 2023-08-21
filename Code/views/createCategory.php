<?php
ob_start();
?>

<div class="hero min-h-screen">
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-white">
        <div class="card-body">
            <form action="/createCategory" method="POST" enctype="multipart/form-data">
                <div class=" form-control">
                    <h1 class="text-3xl font-bold text-center mb-10">Nouvelle catégorie</h1>
                    <label class="label">
                        <span class="label-text">Titre de la catégorie</span>
                    </label>
                    <input required type="text" name="title" placeholder="titre" maxlength="15" class="input input-bordered mb-4" />
                </div>
                <label class="label">
                    <span class="label-text">Icone du sujet</span>
                </label>
                <input name="file" type="file" accept=".png,.jpg,.jpeg" class="file-input file-input-bordered file-input-success w-full max-w-xs" />
                <small>Seulement les fichiers : jpeg, png, jpg</small>
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
                    <button class="btn btn-primary">Créer la catégorie</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    $content = ob_get_clean();
    require "template.php";
    ?>