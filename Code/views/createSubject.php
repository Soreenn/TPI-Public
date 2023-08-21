<?php
ob_start();
?>

<div class="hero min-h-screen">
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
        <div class="card-body">
            <form action="/createSubject" method="POST" enctype="multipart/form-data">
                    <div class=" form-control">
                <h1 class="text-3xl font-bold text-center mb-10">Nouveau sujet</h1>
                <label class="label">
                    <span class="label-text" maxlength="100">Titre du sujet</span>
                </label>
                <input maxlength="100" required type="text" name="title" placeholder="titre" class="input input-bordered" />
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Categorie</span>
            </label>
            <select required name="category" class="select select-bordered w-full max-w-xs">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category->name ?>"><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <label class="label">
            <span class="label-text">Contenu</span>
        </label>
        <textarea name="content" class="textarea textarea-bordered w-full" rows="4" placeholder="contenu" maxlength="255"></textarea>
        <input name="file" type="file" accept=".png,.jpg,.jpeg,.mp4,.mov,.wav" class="mt-4 file-input file-input-bordered file-input-success w-full max-w-xs" />
        <small>Seulement les fichiers : jpeg, png, jpg, mov, wav, mp4.</small>
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
            <button class="btn btn-primary">Créer le sujet</button>
        </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require "template.php";
?>