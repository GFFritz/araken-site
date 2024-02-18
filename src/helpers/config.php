<?php
require_once dirname(__DIR__, 2) . '/src/helpers/Database.php';

// Definindo constantes para caminhos importantes
define('ROOT_PATH', dirname(__DIR__, 2) . '/');
define('VENDOR_PATH', ROOT_PATH . 'vendor/');

// Carregando variáveis de ambiente
require_once VENDOR_PATH . 'autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

// Criando uma instância do banco de dados
$database = new Database();
$conn = $database->conn;

// Query para selecionar as configurações do banco de dados
$query = "SELECT config_name, value FROM config";
$result = $conn->query($query);

// Definindo as constantes com base nas configurações do banco de dados
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    define(strtoupper($row['config_name']), $row['value']);
  }
} else {
  echo "Nenhuma configuração encontrada no banco de dados.";
}
