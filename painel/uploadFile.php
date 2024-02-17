<?php
require_once '../src/helpers/Database.php';

$db = new Database();

// Consulta para obter todas as categorias
$queryCategories = "SELECT * FROM categories ORDER BY name";
$resultCategories = $db->conn->query($queryCategories);
?>
<div id="modelDocument" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
  <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md p-5">
      <div class="flex justify-around items-center">
        <div class="text-lg font-bold">
            Upload de documento
        </div>
        <button onclick="closeModal('modelDocument')" type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="34" viewBox="0 0 32 34" fill="none">
              <path d="M24.73 26H19.42L15.88 21.05L12.22 26H7.12L13.33 17.87L7.33 9.86H12.58L16 14.57L19.51 9.86H24.49L18.49 17.75L24.73 26Z" fill="black"/>
              <rect x="0.5" y="2.5" width="31" height="31" stroke="black"/>
            </svg>
        </button>
      </div>

    <form action="../src/helpers/uploadFile.php" method="post" enctype="multipart/form-data" class="flex flex-col gap-6">
        <div class="flex gap-1 flex-col">
            <label for="title" class="font-semibold">Título:</label>
            <input type="text" id="title" name="title" class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" placeholder="Nome de exebição do documento">
        </div>  
        <div class="flex gap-1 flex-col">
            <label for="category" class="font-semibold">Categoria:</label>
            <select name="category" id="category" class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center">
                <?php
                // Preenche as opções do menu suspenso com as categorias do banco de dados
                if ($resultCategories->num_rows > 0) {
                    while ($row = $resultCategories->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>  
        <div class="flex gap-1 flex-col">
            <label for="file">Arquivo (PDF):</label>
            <input type="file" id="file" name="file">
        </div>  
        <input class="bg-[#006B94] hover:bg-[#006a94c9] transition-all delay-75 text-white rounded p-4 uppercase font-bold" type="submit" value="Enviar">
    </form>

  </div>
</div>

  
<script type="text/javascript">
    window.openModal = function(modalId) {
        document.getElementById(modalId).style.display = 'block'
        document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none'
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

    // Close all modals when press ESC
    document.onkeydown = function(event) {
        event = event || window.event;
        if (event.keyCode === 27) {
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
            let modals = document.getElementsByClassName('modal');
            Array.prototype.slice.call(modals).forEach(i => {
                i.style.display = 'none'
            })
        }
    };
</script>