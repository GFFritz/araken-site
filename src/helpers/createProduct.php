<?php

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verificar se o campo de arquivo foi enviado e se não há erros
  if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
    // Diretório de destino para o upload do arquivo
    $target_dir = "../../public/images/";

    // Obter o nome do arquivo enviado
    $uniqueFilename = generateUniqueFilename($_FILES["image"]["name"]);
    $filename = basename($uniqueFilename);
    $target_file = $target_dir . $filename;

    // Mover o arquivo enviado para o diretório de destino
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      // Arquivo enviado com sucesso, agora você pode processar os outros campos do formulário
      $url = $_POST['file_url'];

      require_once 'Database.php';
      $db = new Database();

      // Preparar a consulta SQL para inserir os dados do produto no banco de dados
      $stmt = $db->conn->prepare("INSERT INTO imagens (url, file_path) VALUES (?, ?)");
      $stmt->bind_param("ss", $url, $filename);

      // Executar a consulta SQL
      if ($stmt->execute()) {
        // Produto e arquivo inseridos com sucesso no banco de dados
        header("Location: ../../painel/index.php");
        echo "Produto criado com sucesso!";
      } else {
        // Se houver um erro ao executar a consulta, exibir uma mensagem de erro
        echo "Desculpe, ocorreu um erro ao criar o produto.";
      }

      // Fechar a conexão com o banco de dados
      $db->closeConnection();
    } else {
      // Se houver um erro ao mover o arquivo, exibir uma mensagem de erro
      echo "Desculpe, ocorreu um erro ao fazer o upload do arquivo.";
    }
  } else {
    // Se não houver arquivo enviado ou se houver erros ao fazer o upload, exibir uma mensagem de erro
    echo "Por favor, selecione um arquivo para fazer upload.";
  }
} else {
  // Se o formulário não foi enviado via POST, redirecionar para a página inicial ou exibir uma mensagem de erro
  echo "Acesso não autorizado.";
}

function generateUniqueFilename($originalFilename)
{
  // Remover espaços em branco do nome de arquivo original
  $originalFilename = str_replace(' ', '', $originalFilename);

  // Gerar um identificador único baseado no timestamp atual
  $uniqueIdentifier = time(); // Você pode usar outras funções de geração de identificador único se preferir

  // Combinar o identificador único com o nome de arquivo original
  $uniqueFilename = $uniqueIdentifier . '.png';

  return $uniqueFilename;
}
