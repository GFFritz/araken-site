<?php
// Inclua o arquivo de configuração e conecte-se ao banco de dados
require_once 'config.php';

// Verifique se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtenha os dados do formulário
  $name = $_POST['name'];
  $url = $_POST['url'];

  // Consulta SQL para inserir um novo link
  $sql = "INSERT INTO links (name, url) VALUES ('$name', '$url')";

  if ($conn->query($sql) === TRUE) {
    header("Location: ../../painel/index.php");
    echo "Link criado com sucesso.";
  } else {
    echo "Erro ao criar link: " . $conn->error;
  }
}

// Feche a conexão com o banco de dados
$database->closeConnection();
