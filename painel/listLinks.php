<div class="inline-block rounded-lg border shadow-md w-full my-4">
  <table class="table-auto w-full py-4">
    <tr>
      <th class="border-b border-r p-1">Nome</th>
      <th class="border-b border-r p-1">URL</th>
      <th class="border-b border-r p-1">Ações</th>
    </tr>
    <?php
    // Inclua o arquivo de configuração e conecte-se ao banco de dados
    require_once '../src/helpers/config.php';

    // Consulta SQL para selecionar todos os registros da tabela "link"
    $query = "SELECT * FROM links";
    $result = $conn->query($query);

    // Verificar se existem registros
    if ($result->num_rows > 0) {
      // Exibir os registros em uma tabela
      while ($row = $result->fetch_assoc()) {
        echo "<tr class='odd:bg-slate-100'>";
        echo "<td class='border-b border-r text-center p-1'>" . $row['name'] . "</td>";
        echo "<td class='border-b border-r text-center p-1'>" . $row['url'] . "</td>";
        echo "<td class='border-b border-r text-center p-1 flex justify-around'>";
        echo "<a class='border border-solid border-zinc-400 rounded w-6 h-6 bg-amber-600 hover:bg-amber-500 float-left text-white text-xs flex justify-center items-center' title='Editar Link'><i class='fa fa-edit' href='javascript:void(0)' onclick='openModal(" . $row['id'] . ")'></i></a>";
        echo "<a class='border border-solid border-zinc-400 rounded w-6 h-6 bg-red-600 hover:bg-red-500 float-left text-white text-xs flex justify-center items-center' title='Remover Link' href='deleteLink.php?id=" . $row['id'] . "' onclick='return confirmDelete()'><i class='fa fa-trash'></i></a>";
        echo "</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='4'>Nenhum registro encontrado.</td></tr>";
    }

    // Fechar a conexão com o banco de dados
    $database->closeConnection();
    ?>
  </table>

  <div id="editLinkModal" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
    <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md p-5">
      <div class="flex justify-between items-center border-b border-[#CAD1E1]">
        <h2 class="text-lg font-medium">Editar Usuário</h2>
        <span class="text-[#aaa] float-right text-[28px] font-bold hover:text-black hover:cursor-pointer" onclick="closeModal()">&times;</span>
      </div>
      <form id="editLinkForm" action="../src/helpers/editLink.php" method="post" class="flex flex-col gap-6 mt-6">
        <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="hidden" id="edit_link_id" name="edit_link_id">
        <div class="flex gap-1 flex-col">
          <label for="edit_name">Titulo:</label>
          <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="text" id="edit_name" name="edit_name">
        </div>
        <div class="flex gap-1 flex-col">
          <label for="edit_url">Url:</label>
          <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="text" id="edit_url" name="edit_url">
        </div>
        <button type="submit" class="bg-primary hover:bg-primary-alt transition-all delay-75 text-white rounded-full p-4 uppercase font-bold">Confirmar</button>
      </form>
    </div>
  </div>
</div>


<script>
  // Função para abrir a modal de edição de usuário
  function openModal(linkId) {
    var linkData = getLinkData(linkId);
    document.getElementById('edit_link_id').value = linkId;
    document.getElementById('edit_name').value = linkData.name;
    document.getElementById('edit_url').value = linkData.url;
    document.getElementById('editLinkModal').style.display = "block";
  }

  // Função para fechar a modal de edição de usuário
  function closeModal() {
    document.getElementById('editLinkModal').style.display = "none";
  }

  // Função para confirmar a exclusão de um usuário
  function confirmDelete() {
    return confirm("Tem certeza de que deseja excluir este link?");
  }

  // Função para obter os dados do usuário via AJAX
  function getLinkData(linkId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../src/helpers/linkData.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if (response.error) {
          alert(response.error); // Exibe mensagem de erro se houver
        } else {
          // Preenche os campos do formulário com os dados do usuário
          document.getElementById('edit_link_id').value = linkId;
          document.getElementById('edit_name').value = response.name;
          document.getElementById('edit_url').value = response.url;
          // Exibe a modal de edição
          document.getElementById('editLinkModal').style.display = "block";
        }
      }
    };
    xhr.send("link_id=" + linkId);
  }
</script>