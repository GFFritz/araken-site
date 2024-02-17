<?php
require_once '../src/helpers/User.php';

session_start();

$user = new User();

// Verifica se o usuário está logado e tem permissão para excluir usuários
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['access_level'] != 2) {
    header("Location: login.php");
    exit;
}

// Verifica se o ID do usuário a ser excluído foi enviado via GET
if(isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Exclui o usuário
    if ($user->deleteUser($userId)) {
        header("Location: listUsers.php"); // Redireciona de volta para a página de listagem de usuários
        exit;
    } else {
        echo "Erro ao excluir usuário.";
        exit;
    }
} else {
    echo "ID do usuário não fornecido.";
    exit;
}
?>
