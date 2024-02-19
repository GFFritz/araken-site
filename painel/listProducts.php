<?php
// Incluir o arquivo de configuração e de conexão com o banco de dados
require_once '../src/helpers/config.php';

// Criar uma instância da classe Database
$database = new Database();

// Função para buscar as imagens do banco de dados
function getImages()
{
  global $database;
  $stmt = $database->conn->prepare("SELECT * FROM imagens");
  $stmt->execute();
  return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Função para exibir a lista de imagens
function displayImageList()
{
  $images = getImages();
  foreach ($images as $image) {
    echo '<div class="flex container items-center justify-between rounded-lg border shadow-md w-full p-4">';
    echo '<img class="w-1/3" src="' . $_ENV['FILES_PATH'] . '/' . $image['file_path'] . '" alt="' . $image['file_path'] . '" class="thumbnail">';
    echo '<div class="flex flex-col gap-3">';
    echo '<div class="flex justify-center items-center gap-3"> Link: <div class="px-3 py-1 border w-full rounded bg-zinc-100">' . $image['url'] . '</div></div>';
    echo '<div class="flex gap-3">';
    echo '<button onclick="openEditProductModal(' . $image['id'] . ')" class="bg-yellow-500 hover:bg-yellow-400 px-4 p-1 text-white rounded flex justify-center items-center gap-2"><i class="fa fa-edit"></i> Editar</button>';
    echo '<button class="bg-red-600 hover:bg-red-500 px-4 p-1 text-white rounded flex justify-center items-center gap-2" title="Remover Produto" onclick="confirmDelete(' . $image['id'] . ')"><i class="fa fa-trash"></i> Remover</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
}

?>

<div class="flex flex-col gap-3 mt-8">
  <div class="flex justify-between mx-4">
    <h1 class="font-semibold text-lg">Produtos:</h1>
    <button class="bg-emerald-600 hover:bg-emerald-500 text-zinc-50 flex gap-3 justify-center items-center w-fit rounded px-6 py-1" onclick="openNewProductModal()">
      <i class="fa fa-plus"></i>
      <span>Adicionar Produto</span>
    </button>
  </div>
  <?php displayImageList(); ?>
</div>

<div id="editProductModal" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
  <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md p-5">
    <div class="flex justify-between items-center border-b border-[#CAD1E1]">
      <h2 class="text-lg font-medium">Editar Produto</h2>
      <span class="text-[#aaa] float-right text-[28px] font-bold hover:text-black hover:cursor-pointer" onclick="closeEditProductModal()">&times;</span>
    </div>
    <form id="editProductForm" action="../src/helpers/editProduct.php" method="post" class="flex flex-col gap-6 mt-6">
      <input type="hidden" id="edit_product_id" name="edit_product_id">
      <div class="flex flex-col">
        <img src="" alt="" id="edit_image" />
      </div>
      <div class="flex flex-col">
        <label for="edit_url" class="text-sm">URL:</label>
        <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder-center" type="text" id="edit_file_url" name="edit_file_url">
      </div>
      <button type="submit" class="bg-primary hover:bg-primary-alt transition-all delay-75 text-white rounded-full p-4 uppercase font-bold">Confirmar</button>
    </form>
  </div>
</div>

<script>
  // Função para abrir a modal de edição de produto
  function openEditProductModal(productId) {
    getProductData(productId)
      .then(productData => {
        document.getElementById('edit_product_id').value = productId;
        document.getElementById('edit_file_url').value = productData.url;
        document.getElementById('edit_image').src = productData.file_path;
        console.log('URL do produto:', productData.url);
        document.getElementById('editProductModal').style.display = "block";
      })
      .catch(error => {
        console.error('Erro ao obter os dados do produto:', error);
      });
  }

  // Função para fechar a modal de edição de produto
  function closeEditProductModal() {
    document.getElementById('editProductModal').style.display = "none";
  }

  // Função para obter os dados do produto via AJAX
  function getProductData(productId) {
    return new Promise((resolve, reject) => {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "../src/helpers/productData.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var response = JSON.parse(this.responseText);
          if (response.error) {
            reject(response.error); // Rejeitar a promessa com uma mensagem de erro se houver
          } else {
            resolve(response); // Resolver a promessa com os dados do produto
          }
        }
      };
      xhr.send("product_id=" + productId);
    });
  }
</script>

<script>
  function confirmDelete(product_id) {
    // Confirmar a exclusão com o usuário
    if (confirm("Tem certeza de que deseja excluir este produto?")) {
      // Enviar solicitação para deleteProduct.php
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "../src/helpers/deleteProduct.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Exibir mensagem de retorno
          alert(this.responseText);
          // Atualizar a página ou realizar outras ações necessárias após a exclusão
          location.reload();
        }
      };
      xhr.send("product_id=" + product_id);
    }
    // Retornar false para evitar que o link seja seguido após a confirmação
    return false;
  }
</script>