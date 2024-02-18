<?php
require_once 'Link.php';

session_start();

$link = new Link();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link_id = $_POST['edit_link_id'];
    $name = $_POST['edit_name'];
    $url = $_POST['edit_url'];

    if ($link->updateLink($link_id, $name, $url)) {
        echo "Link atualizado com sucesso!";
        header("Location: ../../painel/index.php");
    } else {
        echo "Ocorreu um erro ao atualizar o link. Por favor, tente novamente.";
    }
}
