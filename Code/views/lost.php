<?php
ob_start();
?>

<div class="hero min-h-screen">
    <div class="max-w-md">
        <div class="hero-content text-center">
            <h1 class="text-9xl font-bold">4</h1><img class="w-24 mr-4 ml-4" src="https://i.ibb.co/k5kggcT/Logo.png" />
            <h1 class="text-9xl font-bold">4</h1>
        </div>
        <div class="hero-content text-center">
        <h1 class="text-4xl font-bold">The page doesn't exist</h1>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require "template.php";
?>