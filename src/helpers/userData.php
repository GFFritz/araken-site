<?php
require_once 'User.php';

// Verifica se o ID do usuário foi enviado via POST
if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $user = new User();
    $userData = $user->getUserById($user_id);

    // Verifica se os dados do usuário foram encontrados
    if($userData) {
        // Retorna os dados do usuário como JSON
        echo json_encode($userData);
    } else {
        // Retorna uma mensagem de erro caso os dados não sejam encontrados
        echo json_encode(['error' => 'Usuário não encontrado']);
    }
} else {
    // Retorna uma mensagem de erro se o ID do usuário não foi fornecido
    echo json_encode(['error' => 'ID do usuário não fornecido']);
}
?>
