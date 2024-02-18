<?php
require_once '../src/helpers/Link.php';

session_start();

$link = new Link();

// Verifica se o ID do link a ser excluído foi enviado via GET
if (isset($_GET['id'])) {
    $linkId = $_GET['id'];

    // Exclui o Link
    if ($link->deleteLink($linkId)) {
        header("Location: index.php"); // Redireciona de volta para a página de listagem de link
        exit;
    } else {
        echo "Erro ao excluir Link.";
        exit;
    }
} else {
    echo "ID do link não fornecido.";
    exit;
}
