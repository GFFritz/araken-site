<div id="editconfigModal" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
  <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md p-5">
    <div class="flex justify-between items-center border-b border-[#CAD1E1]">
      <h2 class="text-lg font-medium">Configurações do Sistema</h2>
      <span class="text-[#aaa] float-right text-[28px] font-bold hover:text-black hover:cursor-pointer" onclick="closeModalConfig()">&times;</span>
    </div>
    <form id="editConfigForm" action="../src/helpers/editConfig.php" method="post" class="flex flex-col gap-6 mt-6">
      <?php
      // Inclua o arquivo de configuração e conecte-se ao banco de dados
      require_once '../src/helpers/config.php';

      // Consulta SQL para selecionar todas as configurações
      $query = "SELECT config_name, value FROM config";
      $result = $conn->query($query);

      // Verificar se existem configurações
      if ($result->num_rows > 0) {
        // Exibir as configurações em campos de formulário
        while ($row = $result->fetch_assoc()) {
          echo "<div class='flex gap-1 flex-col'>";
          echo "<label for='" . $row['config_name'] . "'>" . ucwords(str_replace("_", " ", $row['config_name'])) . ":</label>";
          echo "<input class='rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center' type='text' id='" . $row['config_name'] . "' name='" . $row['config_name'] . "' value='" . $row['value'] . "'>";
          echo "</div>";
        }
      } else {
        echo "Nenhuma configuração encontrada.";
      }
      ?>
      <input class="bg-primary hover:bg-primary-alt transition-all delay-75 text-white rounded p-4 uppercase font-bold cursor-pointer" type="submit" value="Salvar">
    </form>
  </div>
</div>