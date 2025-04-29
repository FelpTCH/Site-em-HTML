<?php
session_start();
require 'conexao.php';

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $nome, $senha_hash);

    if ($stmt->fetch() && password_verify($senha, $senha_hash)) {
        $_SESSION['usuario_id'] = $id;
        $_SESSION['usuario_nome'] = $nome;
        header("Location: index.php");
        exit();
    } else {
        $erro = "E-mail ou senha inválidos.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Site de Receitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0fff0;
        }
        .card {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .btn-success {
            background-color: #3cb371;
            border-color: #3cb371;
        }
    </style>
</head>
<body>

<div class="card p-4">
    <h2 class="text-center mb-4">Entrar</h2>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Senha:</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Entrar</button>
    </form>

    <div class="mt-3 text-center">
        <p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
</div>

</body>
</html>
