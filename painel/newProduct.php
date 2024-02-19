<div id="newProductModal" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
  <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md p-5">
    <div class="flex justify-between items-center border-b border-[#CAD1E1]">
      <h2 class="text-lg font-medium">Editar Produto</h2>
      <span class="text-[#aaa] float-right text-[28px] font-bold hover:text-black hover:cursor-pointer" onclick="closeNewProductModal()">&times;</span>
    </div>
    <form id="editProductForm" action="../src/helpers/createProduct.php" method="post" class="flex flex-col gap-6 mt-6" enctype="multipart/form-data">
      <div class="flex flex-col">
        <label for="image" class="text-sm">Imagem:</label>
        <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder-center" type="file" id="image" name="image">
      </div>
      <div class="flex flex-col">
        <label for="url" class="text-sm">URL:</label>
        <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder-center" type="text" id="file_url" name="file_url">
      </div>
      <button type="submit" class="bg-primary hover:bg-primary-alt transition-all delay-75 text-white rounded-full p-4 uppercase font-bold">Confirmar</button>
    </form>
  </div>
</div>

<script>
  // Função para abrir a modal de novo produto
  function openNewProductModal() {
    document.getElementById('newProductModal').classList.remove('hidden');
  }

  // Função para fechar a modal de novo produto
  function closeNewProductModal() {
    document.getElementById('newProductModal').classList.add('hidden');
  }
</script>