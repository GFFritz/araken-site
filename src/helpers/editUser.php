<?php
require_once 'User.php';

session_start();

$user = new User();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];

    if ($user->updateUser($user_id, $username)) {
        echo "Usuário atualizado com sucesso!";
        header("Location: painel/listUsers.php");
    } else {
        echo "Ocorreu um erro ao atualizar o usuário. Por favor, tente novamente.";
    }
}
