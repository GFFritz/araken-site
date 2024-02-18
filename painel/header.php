<?php require_once('../src/helpers/config.php'); ?>

<div class="container">
  <div class="flex justify-between items-center my-8">
    <a href="<?php $_ENV['APP_URL']; ?>" class="bg-primary hover:bg-primary-alt delay-100 transition-all rounded-full text-zinc-50 px-4 py-1">Home</a>
    <a href="../src/helpers/logout.php" class="bg-red-600 hover:bg-red-500 delay-100 transition-all rounded-full text-zinc-50 px-4 py-1">Logout</a>
  </div>


</div>