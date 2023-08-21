<?php
ob_start();
?>

<div class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden py-6 sm:py-12">
  <div class="max-w-xl px-5 text-center">
    <h2 class="mb-4 text-5xl font-bold">Plus qu'une étape !</h2>
    <p class="mb-2 text-lg">Vous devez confirmer votre email, nous vous avons envoyé un email contenant un lien de confirmation à l'addresse suivante : <span class="font-medium text-indigo-500"><?=$_SESSION['email']?></span>.</p>
    <a href="/sendVerifyEmail"><button class="btn btn-primary w-full mt-4">Renvoyer un email</button></a>
  </div>
</div>

<?php
$content = ob_get_clean();
require "template.php";
?>