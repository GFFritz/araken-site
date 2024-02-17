<?php 
// Definindo constantes para caminhos importantes
define('ROOT_PATH', dirname(__DIR__, 2) . '/');
define('VENDOR_PATH', ROOT_PATH . 'vendor/');

// Carregando variáveis de ambiente
require_once VENDOR_PATH . 'autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();
?>