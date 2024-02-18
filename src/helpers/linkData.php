<?php
require_once 'Link.php';

// Verifica se o ID do usuário foi enviado via POST
if (isset($_POST['link_id'])) {
    $link_id = $_POST['link_id'];
    $link = new Link();
    $linkData = $link->getLinkById($link_id);

    // Verifica se os dados do usuário foram encontrados
    if ($linkData) {
        // Retorna os dados do usuário como JSON
        echo json_encode($linkData);
    } else {
        // Retorna uma mensagem de erro caso os dados não sejam encontrados
        echo json_encode(['error' => 'Link não encontrado']);
    }
} else {
    // Retorna uma mensagem de erro se o ID do usuário não foi fornecido
    echo json_encode(['error' => 'ID do link não fornecido']);
}
