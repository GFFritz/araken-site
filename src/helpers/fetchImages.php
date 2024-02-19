<?php
// Inclua o arquivo de configuração e conecte-se ao banco de dados
require_once 'config.php';

// Caminho base para as imagens
$imageBasePath = $_ENV['FILES_PATH']; // Suponha que IMAGE_BASE_PATH seja uma variável de ambiente definida em seu arquivo de configuração

// Consulta SQL para selecionar todas as imagens
$query = "SELECT id, file_path, url FROM imagens";
$result = $conn->query($query);

// Verificar se existem imagens
if ($result->num_rows > 0) {
  $images = array();
  // Exibir as imagens em um array
  while ($row = $result->fetch_assoc()) {
    // Formar o caminho completo da imagem
    $imagePath = $imageBasePath . $row['file_path'];

    // Adicionar a imagem ao array
    $images[] = array(
      'id' => $row['id'],
      'file_path' => $imagePath, // Caminho completo da imagem
      'url' => $row['url'],
      'displayed' => false // Adicione uma chave para marcar se a imagem está sendo exibida ou não
    );
  }
  // Retorna o array de imagens como JSON
  echo json_encode($images);
} else {
  // Se não houver imagens, retorna um array vazio
  echo json_encode(array());
}

// Fechar a conexão com o banco de dados
$database->closeConnection();
