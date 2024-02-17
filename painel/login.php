<?php
require_once '../src/helpers/User.php';

$user = new User();

session_start();

// Verifica se o usuário está logado, se sim, redireciona para a página principal
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  header("Location: index.php");
  exit;
}

$username_error = $password_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST['username'])) {
    $username_error = "Por favor, insira o nome de usuário.";
  } else {
    $username = $_POST['username'];
  }

  if (empty($_POST['password'])) {
    $password_error = "Por favor, insira a senha.";
  } else {
    $password = $_POST['password'];
  }

  if (!empty($username) && !empty($password)) {
    if ($user->login($username, $password)) {
      header("Location: index.php");
      exit;
    } else {
      $password_error = "Credenciais inválidas. Tente novamente.";
    }
  }
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

<body class="overflow-hidden">
  <div class="flex flex-col w-screen h-screen justify-between py-20">
    <div class="flex flex-col justify-center items-center container gap-4">

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="flex flex-col gap-4 text-[18px] w-full px-8" method="post">
        <div class="flex flex-col">
          <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="text" id="username" name="username" placeholder="Digite seu E-mail">
        </div>
        <div class="flex flex-col">
          <input class="rounded px-4 py-3 border border-[#CAD1E1] border-solid placeholder:text-center" type="password" id="password" name="password" placeholder="Digite sua senha">
          <div class="text-red-400 text-xs text-center mt-2">
            <?php echo $password_error; ?>
          </div>
        </div>
        <button class="bg-[#006B94] hover:bg-[#006a94c9] transition-all delay-75 text-white rounded p-4 uppercase font-bold" type="submit">Entrar</button>
      </form>
    </div>
  </div>

</body>

</html>