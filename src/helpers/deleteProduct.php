<?php
// Verificar se o ID do produto foi fornecido
if (isset($_POST['product_id'])) {
  // ID do produto a ser excluído
  $product_id = $_POST['product_id'];

  // Conectar ao banco de dados
  require_once 'Database.php';
  $db = new Database();

  // Primeiro, obter o caminho do arquivo de imagem associado ao produto
  $stmt_select = $db->conn->prepare("SELECT file_path FROM imagens WHERE id = ?");
  $stmt_select->bind_param("i", $product_id);
  $stmt_select->execute();
  $stmt_select->bind_result($file_path);
  $stmt_select->fetch();
  $stmt_select->close();

  // Se um arquivo estiver associado ao produto, exclua-o
  if ($file_path) {
    $target_dir = "../../public/images/";
    $target_file = $target_dir . $file_path;
    if (file_exists($target_file)) {
      unlink($target_file); // Excluir o arquivo do servidor
    }
  }

  // Agora, exclua o registro do produto do banco de dados
  $stmt_delete = $db->conn->prepare("DELETE FROM imagens WHERE id = ?");
  $stmt_delete->bind_param("i", $product_id);

  if ($stmt_delete->execute()) {
    echo "Produto excluído com sucesso!";
    header("Location: ../../painel/index.php");
  } else {
    echo "Desculpe, ocorreu um erro ao excluir o produto.";
  }

  // Fechar a conexão com o banco de dados
  $db->closeConnection();
} else {
  // Se o ID do produto não foi fornecido, exibir uma mensagem de erro
  echo "ID do produto não fornecido.";
}
