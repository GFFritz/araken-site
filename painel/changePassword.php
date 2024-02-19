<div id="modelPassword" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
  <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md p-5">
    <div class="flex justify-between items-center">
      <div>
        Alterar Senha
      </div>
      <span class="text-[#aaa] float-right text-[28px] font-bold hover:text-black hover:cursor-pointer" onclick="closeModalPassword('modelPassword')">&times;</span>
    </div>

    <form id="changePasswordForm" action="../src/helpers/changePassword.php" method="post" class="flex flex-col gap-6">
      <div class="flex gap-1 flex-col">
        <label for="current_password">Senha atual:</label>
        <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="password" id="current_password" name="current_password">
      </div>
      <div class="flex gap-1 flex-col">
        <label for="new_password">Nova senha:</label>
        <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="password" id="new_password" name="new_password">
      </div>
      <div class="flex gap-1 flex-col">
        <label for="confirm_password">Confirmar nova senha:</label>
        <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="password" id="confirm_password" name="confirm_password">
      </div>
      <button type="submit" class="bg-primary hover:bg-primary-alt transition-all delay-75 text-white rounded p-4 uppercase font-bold">Confirmar</button>
    </form>

  </div>
</div>

<script type="text/javascript">
  window.openModalPassword = function(modalId) {
    document.getElementById(modalId).style.display = 'block'
    document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
  }

  window.closeModalPassword = function(modalId) {
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