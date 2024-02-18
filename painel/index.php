<?php
require_once '../src/helpers/User.php';

$user = new User();

session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GeoLaw</title>
  <link rel="stylesheet" href='../assets/css/style.css'>

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="overflow-hidden font-montserrat">
  <?php
  require_once('header.php');
  require_once('changePassword.php');
  ?>

  <div class="container flex flex-col justify-center items-center">
    <?php require_once('newLink.php'); ?>
    <button class="bg-primary hover:bg-primary-alt text-zinc-50 flex gap-3 justify-center items-center w-fit rounded-full px-6 py-1" onclick="openModalNewLink('modelNewLink')">
      <i class="fa fa-plus"></i>
      <span>Adicionar novo link</span>
    </button>
    <?php require_once('listLinks.php'); ?>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>