<?php
$mysqli = new mysqli("localhost", "root", "", "sabores");

if ($mysqli->connect_error) {
  die("Erro na conexão: " . $mysqli->connect_error);
}

$titulo = $_POST['titulo'];
$ingredientes = $_POST['ingredientes'];
$preparo = $_POST['preparo'];

$stmt = $mysqli->prepare("INSERT INTO receitas (titulo, ingredientes, preparo) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $titulo, $ingredientes, $preparo);

if ($stmt->execute()) {
  echo "Receita salva com sucesso!";
} else {
  echo "Erro ao salvar: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
