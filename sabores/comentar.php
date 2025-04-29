<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$receita_id = $_POST['receita_id'];
$comentario = trim($_POST['comentario']);

if (!empty($comentario)) {
    $stmt = $conn->prepare("INSERT INTO comentarios (usuario_id, receita_id, texto) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $usuario_id, $receita_id, $comentario);
    $stmt->execute();
    $stmt->close();
}

header("Location: bolo_chocolate.php"); // ou a página da receita atual
exit();
?>
