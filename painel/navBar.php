<!-- component -->
<nav class="relative px-4 py-4 flex justify-end items-center bg-white">
  <div class="">
    <button class="navbar-burger flex items-center text-blue-600 p-3">
      <svg class="block h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <title>Mobile menu</title>
        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
      </svg>
    </button>
  </div>
</nav>
<div class="navbar-menu relative z-50 hidden">
  <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
  <nav class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
    <div class="flex items-center justify-end mb-8">
      <button class="navbar-close">
        <svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div>
      <ul>
        <li class="mb-1">
          <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="/painel">Inicio</a>
        </li>
        <li class="mb-1">
          <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="/">Voltar ao site</a>
        </li>
        <li class="mb-1">
          <button class="flex w-full p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" onclick="openModalConfig()">Configurações</button>
        </li>
        <li class="mb-1">
          <button class="flex w-full p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" onclick="openUploadPdfModal()">Atualizar documento</button>
        </li>
        <li class="mb-1">
          <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="listUsers.php">Usuários</a>
        </li>
        <li class="mb-1">
          <button class="flex w-full p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" onclick="openModalPassword('modelPassword')">Alterar senha</button>
        </li>
      </ul>
    </div>
    <div class=" mt-auto">
      <div class="pt-6">
        <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-red-600 hover:bg-red-700 delay-100 transition-all rounded-xl" href="../src/helpers/logout.php">Logout</a>
      </div>
      <p class="my-4 text-xs text-center text-gray-400">
        <span>Copyright © <?php echo date("Y") ?></span>
      </p>
    </div>
  </nav>
</div>

<?php
require_once('listConfigs.php');
require_once('changePassword.php');
require_once('updateDocument.php');
?>

<script>
  function openModalConfig() {
    document.getElementById('editconfigModal').style.display = "block";
  }

  function closeModalConfig() {
    document.getElementById('editconfigModal').style.display = "none";
  }

  // Burger menus
  document.addEventListener('DOMContentLoaded', function() {
    // open
    const burger = document.querySelectorAll('.navbar-burger');
    const menu = document.querySelectorAll('.navbar-menu');

    if (burger.length && menu.length) {
      for (var i = 0; i < burger.length; i++) {
        burger[i].addEventListener('click', function() {
          for (var j = 0; j < menu.length; j++) {
            menu[j].classList.toggle('hidden');
          }
        });
      }
    }

    // close
    const close = document.querySelectorAll('.navbar-close');
    const backdrop = document.querySelectorAll('.navbar-backdrop');

    if (close.length) {
      for (var i = 0; i < close.length; i++) {
        close[i].addEventListener('click', function() {
          for (var j = 0; j < menu.length; j++) {
            menu[j].classList.toggle('hidden');
          }
        });
      }
    }

    if (backdrop.length) {
      for (var i = 0; i < backdrop.length; i++) {
        backdrop[i].addEventListener('click', function() {
          for (var j = 0; j < menu.length; j++) {
            menu[j].classList.toggle('hidden');
          }
        });
      }
    }
  });
</script>