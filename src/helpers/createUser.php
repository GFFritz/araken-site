<?php
require_once 'User.php';

session_start();

$user = new User();

// Verifica se o usuário está logado e tem permissão para criar usuários
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['access_level'] != 2) {
    header("Location: login.php");
    exit;
}

// Verifica se o formulário de criação de usuário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validação básica
    if (empty($username) || empty($password)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // Verifica se o usuário já existe
    if ($user->getUserByUsername($username)) {
        echo "O usuário já existe.";
        exit;
    }

    // Cria o usuário
    if ($user->createUser($username, $password)) {
        echo "Usuário criado com sucesso!";
        header("Location: ../../painel/listUsers.php");
    } else {
        echo "Ocorreu um erro ao criar o usuário. Por favor, tente novamente.";
    }
}
