<?php
// productData.php

// Inclua o arquivo de configuração do banco de dados
require_once 'config.php';

// Verifique se o ID do produto foi enviado via POST
if (isset($_POST['product_id'])) {
  // Obtenha o ID do produto
  $productId = $_POST['product_id'];

  // Crie uma consulta preparada para obter os dados do produto
  $stmt = $conn->prepare("SELECT * FROM imagens WHERE id = ?");
  $stmt->bind_param("i", $productId);

  // Execute a consulta preparada
  $stmt->execute();

  // Obtenha o resultado da consulta
  $result = $stmt->get_result();

  // Verifique se o produto foi encontrado
  if ($result->num_rows > 0) {
    // Obtenha os dados do produto
    $productData = $result->fetch_assoc();

    // Adicione $_ENV['FILES_PATH'] ao file_path
    $productData['file_path'] = $_ENV['FILES_PATH'] . $productData['file_path'];

    // Retorne os dados do produto como JSON
    echo json_encode($productData);
  } else {
    // Se o produto não for encontrado, retorne um erro
    echo json_encode(array('error' => 'Produto não encontrado.'));
  }

  // Feche a consulta preparada
  $stmt->close();
} else {
  // Se o ID do produto não foi enviado, retorne um erro
  echo json_encode(array('error' => 'ID do produto não fornecido.'));
}
