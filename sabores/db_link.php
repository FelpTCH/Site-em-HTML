<?php
$host = "localhost"; // Ajuste conforme seu servidor
$user = "root";      // Usuário do banco de dados
$password = "";      // Senha do banco de dados
$dbname = "receitas_db"; // Nome do banco de dados

// Conexão com o MySQL
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
