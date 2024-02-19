<div id="uploadPdfModal" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4" onsubmit="return confirmUploadPdf()">
  <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md p-5">
    <div class="flex justify-between items-center border-b border-[#CAD1E1]">
      <h2 class="text-lg font-medium">Upload de PDF</h2>
      <span class="text-[#aaa] float-right text-[28px] font-bold hover:text-black hover:cursor-pointer" onclick="closeUploadPdfModal()">&times;</span>
    </div>
    <form id="uploadPdfForm" action="../src/helpers/uploadDocument.php" method="post" enctype="multipart/form-data" class="flex flex-col gap-6 mt-6">
      <div class="flex flex-col">
        <label for="arquivo_pdf" class="text-sm">Selecione o arquivo PDF:</label>
        <input type="file" id="arquivo_pdf" name="arquivo_pdf" accept=".pdf" class="rounded px-4 py-3 border border-[#CAD1E1] border-solid">
      </div>
      <button type="submit" class="bg-primary hover:bg-primary-alt transition-all delay-75 text-white rounded-full p-4 uppercase font-bold">Enviar PDF</button>
    </form>
  </div>
</div>

<script>
  function confirmUploadPdf() {
    return confirm("Ao atualizar o documento, você irá substituir o documento atigo. Deseja realmente fazer o upload do PDF?");
  }

  function openUploadPdfModal() {
    document.getElementById('uploadPdfModal').style.display = "block";
  }

  function closeUploadPdfModal() {
    document.getElementById('uploadPdfModal').style.display = "none";
  }
</script>