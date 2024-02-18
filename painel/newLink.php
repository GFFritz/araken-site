<div id="modelNewLink" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
  <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md p-5">
    <div class="flex justify-between items-center">
      <div>
        Alterar Senha
      </div>
      <span class="text-[#aaa] float-right text-[28px] font-bold hover:text-black hover:cursor-pointer" onclick="closeModalNewLink('modelNewLink')">&times;</span>
    </div>

    <form action="../src/helpers/createLink.php" method="post" class="flex flex-col gap-6">
      <div class="flex gap-1 flex-col">
        <label for="name">Titulo:</label>
        <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="text" id="name" name="name">
      </div>
      <div class="flex gap-1 flex-col">
        <label for="url">Url:</label>
        <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="text" id="url" name="url">
      </div>
      <button type="submit" class="bg-primary hover:bg-primary-alt transition-all delay-75 text-white rounded-full p-4 uppercase font-bold">Confirmar</button>
    </form>

  </div>
</div>

<script type="text/javascript">
  window.openModalNewLink = function(modalId) {
    document.getElementById(modalId).style.display = 'block'
    document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
  }

  window.closeModalNewLink = function(modalId) {
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