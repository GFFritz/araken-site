<?php
// Inclua o arquivo de configuração e conecte-se ao banco de dados
require_once 'config.php';

// Verifique se os dados do formulário foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Iterar sobre os dados do formulário para atualizar as configurações
  foreach ($_POST as $config_name => $value) {
    // Prevenir injeção de SQL escapando as variáveis
    $config_name = $conn->real_escape_string($config_name);
    $value = $conn->real_escape_string($value);

    // Consulta SQL para atualizar a configuração no banco de dados
    $query = "UPDATE config SET value = '$value' WHERE config_name = '$config_name'";
    $result = $conn->query($query);

    if (!$result) {
      echo "Erro ao atualizar a configuração '" . $config_name . "'.";
      // Se houver um erro, você pode lidar com ele aqui, como registrar ou exibir uma mensagem de erro.
    }
  }

  // Redirecionar de volta para a página de configurações após a atualização
  header("Location: ../../painel/index.php");
  exit();
} else {
  // Se os dados não foram enviados via POST, redirecione de volta para a página de configurações
  header("Location: ../../painel/index.php");
  exit();
}

// Fechar a conexão com o banco de dados
$database->closeConnection();
