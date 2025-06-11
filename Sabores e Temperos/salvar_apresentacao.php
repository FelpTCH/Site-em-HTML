<?php
session_start();

if (!isset($_SESSION['usuario']) || !is_array($_SESSION['usuario'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $apresentacao = trim($_POST['apresentacao'] ?? '');

  // Atualizar no banco
  $conn = new mysqli("localhost", "root", "", "sabores");
  if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
  }

  $sql = "UPDATE usuarios SET apresentacao = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $apresentacao, $_SESSION['usuario']['id']);

  if ($stmt->execute()) {
    // Atualiza na sessão também
    $_SESSION['usuario']['apresentacao'] = $apresentacao;
    header("Location: perfil.php?msg=Apresentação atualizada com sucesso");
    exit();
  } else {
    echo "Erro ao salvar apresentação.";
  }

  $stmt->close();
  $conn->close();
} else {
  header("Location: perfil.php");
  exit();
}
?>
