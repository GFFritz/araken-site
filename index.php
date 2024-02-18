<?php require_once('src/helpers/config.php'); ?>
<?php require_once('src/partials/header.php'); ?>

<main class="min-h-screen max-w-[514px] pt-4">
  <div class="container flex">
    <div class="flex justify-between items-center px-10 py-4 w-full rounded-full relative">
      <div class="absolute w-full h-full bg-primary rounded-full right-0 blur-[3px]"></div>
      <div class="flex justify-center items-center z-10">
        <i class="fab fa-instagram text-[24px]"></i>
      </div>
      <span class="z-10">@<?php echo USERNAME; ?></span>
      <a class="rounded-full z-10 p-1 px-4 text-xs border border-white hover:bg-primary-alt transition-all delay-100" href="<?php echo INSTAGRAM_LINK; ?>" target="_blank">Seguir</a>
    </div>
  </div>
  <div class="flex bg-[url(/assets/img/bg-header.png)] bg-cover relative">
    <img src="/assets/img/bg-header.png" class="opacity-0 w-full">
    <div class="flex flex-col items-center justify-center text-center absolute w-1/3 top-28 left-16 gap-3">
      <span>CEO na T+ Saúde e Micro Franqueado Acqualive</span>
      <a class="transition-all delay-100 px-5 py-2 rounded-full text-sm w-fit relative group" href="<?php echo CONTACT_LINK; ?>">
        <div class="absolute w-full h-full blur-[3px] bg-primary group-hover:bg-primary-alt shadow-button right-0 top-0 rounded-full z-0"></div>
        <span class="z-10 relative">Adicionar Contato</span>
      </a>
    </div>
  </div>

  <div class="container flex flex-col gap-5 pb-16 pt-4">
    <?php
    $query = "SELECT * FROM links";
    $resultLinks = $conn->query($query);

    if ($resultLinks->num_rows > 0) {
      while ($row = $resultLinks->fetch_assoc()) {
    ?>
        <a href="<?php echo $row['url'] ?>" class="btn-primary relative bg-cover group">
          <div class="w-full blur-[3px] h-full bg-primary group-hover:bg-primary-alt rounded-full absolute shadow-button"></div>
          <span class="blur-0 z-10"><?php echo ucwords($row['name']) ?></span>
        </a>
    <?php
      }
    } else {
      echo "Nenhum registro encontrado.";
    }
    ?>
  </div>

  <div class="py-10 relative">
    <div class="absolute bg-primary w-full h-full top-0 z-0 blur-[6px]"></div>
    <div class="relative flex justify-center items-center mb-5 z-10">Principais Produtos</div>
    <div class="relative container rounded-2xl bg-white z-10">
      <img class="w-full px-0 mx-0" src="assets/img/product.png" alt="" srcset="">
    </div>
  </div>
</main>


<?php require_once('src/partials/footer.php'); ?>