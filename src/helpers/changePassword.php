<?php
require_once 'User.php';

session_start();

$user = new User();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($user->changePassword($username, $current_password, $new_password, $confirm_password)) {
        echo "Senha alterada com sucesso!";
    } else {
        echo "Ocorreu um erro ao alterar a senha. Por favor, tente novamente.";
    }
}
?>