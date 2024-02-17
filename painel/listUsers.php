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
</head>

<body class="">
  <?php require_once('header.php'); ?>
  <div class="container p-4 flex flex-col gap-6 justify-center">

    <div class="flex justify-between">
      <div class="text-[20px] font-semibold">Usuários</div>
      <button onclick="openCreateUserModal()" class="bg-[#006B94] hover:bg-[#006a94c9] transition-all delay-75 text-white rounded py-2 px-6 uppercase font-bold text-[14px] flex gap-3 items-center justify-center">
        <img class='h-[16px]' src='../assets/img/add-user.svg' /> Novo Usuário
      </button>
    </div>
    <div class="inline-block rounded-lg border shadow-md">
      <table class="table-auto w-full">
        <thead>
          <tr>
            <th class="border-b border-r p-1">ID</th>
            <th class="border-b border-r p-1">Login</th>
            <th class="border-b border-r p-1">Nível de acesso</th>
            <th class="border-b border-r p-1">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once '../src/helpers/User.php';

          $user = new User();
          $users = $user->getAllUsers();

          foreach ($users as $userData) {
            $isYou = $userData['id'] != $_SESSION['user_id'];
            echo "<tr class='odd:bg-slate-100'>";
            echo "<td class='border-b border-r text-center p-1'>" . $userData['id'] . "</td>";
            echo "<td class='border-b border-r text-center p-1'>" . $userData['username'];
            if (!$isYou) {
              echo "<span class='text-zinc-400'> (Você)</span>";
            }
            echo "</td>";
            echo "<td class='border-b border-r text-center p-1'>" . ($userData['access_level'] == 1 ? 'Associado' : 'Admin') . "</td>";
            echo "<td class='border-b border-r text-center p-1'>";
            echo "<div class='flex justify-around'>";
            if ($isYou) {
              echo "<a class='border border-solid border-zinc-400 rounded p-1 bg-[#006B94] hover:bg-[#006a94c9] float-left' title='Editar usuário' href='javascript:void(0)' onclick='openModal(" . $userData['id'] . ")'>";
              echo "<img class='h-[14px]' src='../assets/img/edit.svg' />";
              echo "</a>";
              echo "<a class='border border-solid border-zinc-400 rounded p-1 bg-red-500 hover:bg-red-600' title='Apagar usuário' href='deleteUser.php?id=" . $userData['id'] . "' onclick='return confirmDelete()'>";
              echo "<img class='h-[14px]' src='../assets/img/delete.svg' /></a>";
            } else {
              echo "<div>/</div>";
            }
            echo "</div>";
            echo "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div id="editUserModal" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
    <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md p-5">
      <div class="flex justify-between items-center border-b border-[#CAD1E1]">
        <h2 class="text-lg font-medium">Editar Usuário</h2>
        <span class="text-[#aaa] float-right text-[28px] font-bold hover:text-black hover:cursor-pointer" onclick="closeModal()">&times;</span>
      </div>
      <form id="editUserForm" action="../src/helpers/editUser.php" method="post" class="flex flex-col gap-6 mt-6">
        <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="hidden" id="edit_user_id" name="user_id">
        <div class="flex flex-col gap-1">
          <label for="edit_username" class="font-semibold">Login:</label>
          <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="text" id="edit_username" name="username">
        </div>
        <div class="flex flex-col gap-1">
          <label for="edit_access_level" class="font-semibold">Acesso:</label>
          <select class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" id="edit_access_level" name="access_level">
            <option value="1">Associado</option>
            <option value="2">Admin</option>
          </select>
        </div>
        <div>
          <button type="submit" class="bg-[#006B94] hover:bg-[#006a94c9] w-full transition-all delay-75 text-white rounded p-4 uppercase font-bold">Atualizar</button>
        </div>
      </form>
    </div>
  </div>

  <div id="createUserModal" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
    <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md p-5">
      <div class="flex justify-between items-center border-b border-[#CAD1E1]">
        <h2 class="text-lg font-medium">Cadastrar novo usuário</h2>
        <span class="text-[#aaa] float-right text-[28px] font-bold hover:text-black hover:cursor-pointer" onclick="closeCreateUserModal()">&times;</span>
      </div>
      <form id="editUserForm" action="../src/helpers/createUser.php" method="post" class="flex flex-col gap-6 mt-6">
        <div class="flex flex-col gap-1">
          <label for="create_username" class="font-semibold">Login:</label>
          <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="text" id="create_username" name="username">
        </div>
        <div class="flex flex-col gap-1">
          <label for="create_password" class="font-semibold">Login:</label>
          <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="password" id="create_password" name="password">
        </div>
        <div class="flex flex-col gap-1">
          <label for="create_access_level" class="font-semibold">Acesso:</label>
          <select class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" id="create_access_level" name="access_level">
            <option value="1">Associado</option>
            <option value="2">Admin</option>
          </select>
        </div>
        <div>
          <button type="submit" class="bg-[#006B94] hover:bg-[#006a94c9] w-full transition-all delay-75 text-white rounded p-4 uppercase font-bold">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Função para abrir a modal de edição de usuário
    function openModal(userId) {
      var userData = getUserData(userId);
      document.getElementById('edit_user_id').value = userId;
      document.getElementById('edit_username').value = userData.username;
      document.getElementById('edit_access_level').value = userData.access_level;
      document.getElementById('editUserModal').style.display = "block";
    }

    // Função para fechar a modal de edição de usuário
    function closeModal() {
      document.getElementById('editUserModal').style.display = "none";
    }

    // Função para abrir a modal de criação de usuário
    function openCreateUserModal() {
      // Limpa os campos da modal de edição
      document.getElementById('create_username').value = "";
      document.getElementById('create_access_level').value = "1";
      // Exibe a modal de criação
      document.getElementById('createUserModal').style.display = "block";
    }

    // Função para fechar a modal de edição de usuário
    function closeCreateUserModal() {
      document.getElementById('createUserModal').style.display = "none";
    }

    // Função para confirmar a exclusão de um usuário
    function confirmDelete() {
      return confirm("Tem certeza de que deseja excluir este usuário?");
    }

    // Função para obter os dados do usuário via AJAX
    function getUserData(userId) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "../src/helpers/userData.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var response = JSON.parse(this.responseText);
          if (response.error) {
            alert(response.error); // Exibe mensagem de erro se houver
          } else {
            // Preenche os campos do formulário com os dados do usuário
            document.getElementById('edit_user_id').value = userId;
            document.getElementById('edit_username').value = response.username;
            document.getElementById('edit_access_level').value = response.access_level;
            // Exibe a modal de edição
            document.getElementById('editUserModal').style.display = "block";
          }
        }
      };
      xhr.send("user_id=" + userId);
    }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>