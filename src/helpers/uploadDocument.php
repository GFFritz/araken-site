<?php
// Nome fixo para o arquivo PDF
$nomeFixo = "contato-araken.pdf";

// Caminho completo para o arquivo PDF
$caminhoArquivo = '../../public/documents/' . $nomeFixo;

// Verificar se o arquivo existe e remover, se necessário
if (file_exists($caminhoArquivo)) {
  unlink($caminhoArquivo); // Remove o arquivo existente
}

// Realizar o upload do novo arquivo PDF
if ($_FILES["arquivo_pdf"]["error"] == UPLOAD_ERR_OK) {
  $caminhoTemp = $_FILES["arquivo_pdf"]["tmp_name"];
  move_uploaded_file($caminhoTemp, $caminhoArquivo);
  echo "Upload do arquivo PDF realizado com sucesso!";
  header("Location: ../../painel/index.php");
} else {
  echo "Erro ao fazer o upload do arquivo PDF.";
}
