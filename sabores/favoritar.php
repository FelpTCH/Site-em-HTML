<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$receita_id = $_POST['receita_id'];

// Verifica se já foi favoritado
$stmt = $conn->prepare("SELECT id FROM favoritos WHERE usuario_id = ? AND receita_id = ?");
$stmt->bind_param("ii", $usuario_id, $receita_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO favoritos (usuario_id, receita_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $usuario_id, $receita_id);
    $stmt->execute();
}

$stmt->close();
header("Location: bolo_chocolate.php");
exit();
?>
