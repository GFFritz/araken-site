<?php
require_once 'Product.php';
session_start();

$product = new Product();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header("Location: index.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $product_id = $_POST['edit_product_id'];
  $url = $_POST['edit_file_url'];

  // Atualizar o produto usando o método updateProduct do objeto $product
  if ($product->updateProduct($product_id, $url)) {
    echo "Produto atualizado com sucesso!";
    header("Location: ../../painel/index.php");
  } else {
    echo "Ocorreu um erro ao atualizar o produto. Por favor, tente novamente.";
  }
}
