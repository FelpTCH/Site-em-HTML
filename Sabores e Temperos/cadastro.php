<?php
$host = "localhost";
$db = "sabores";
$user = "root";
$pass = ""; // padrão no XAMPP

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senha);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
    