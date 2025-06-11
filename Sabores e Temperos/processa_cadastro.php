<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: perfil.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: cadastro.php");
    exit;
}

if (!isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['confirmaSenha'])) {
    $mensagem = "Dados incompletos.";
    $sucesso = false;
    goto mostrarMensagem;
}

$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$senhaOriginal = $_POST['senha'];
$senhaConfirmada = $_POST['confirmaSenha'];

// Validações
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $mensagem = "E-mail inválido.";
    $sucesso = false;
    goto mostrarMensagem;
}

if (strlen($senhaOriginal) < 6) {
    $mensagem = "A senha deve ter pelo menos 6 caracteres.";
    $sucesso = false;
    goto mostrarMensagem;
}

if ($senhaOriginal !== $senhaConfirmada) {
    $mensagem = "As senhas não coincidem.";
    $sucesso = false;
    goto mostrarMensagem;
}

// Conexão com banco
$host = "localhost";
$db = "sabores";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    $mensagem = "Erro de conexão com o banco de dados.";
    $sucesso = false;
    goto mostrarMensagem;
}

// Verifica se e-mail já está cadastrado
$verifica = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$verifica->bind_param("s", $email);
$verifica->execute();
$verifica->store_result();

if ($verifica->num_rows > 0) {
    $mensagem = "Este e-mail já está cadastrado.";
    $sucesso = false;
} else {
    $senhaHash = password_hash($senhaOriginal, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senhaHash);

    if ($stmt->execute()) {
        $_SESSION['usuario_id'] = $stmt->insert_id;
        $mensagem = "Cadastro realizado com sucesso!";
        $sucesso = true;
    } else {
        $mensagem = "Erro ao cadastrar: " . $stmt->error;
        $sucesso = false;
    }

    $stmt->close();
}

$verifica->close();
$conn->close();

mostrarMensagem:
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card p-5 shadow" style="max-width: 500px; width: 100%;">
    <h2 class="text-center mb-4">
        <?= $sucesso ? "Sucesso!" : "Erro no Cadastro" ?>
    </h2>

    <div class="alert <?= $sucesso ? 'alert-success' : 'alert-danger' ?>" role="alert">
        <?= htmlspecialchars($mensagem) ?>
    </div>

    <?php if ($sucesso): ?>
        <div class="text-center">
            <a href="perfil.php" class="btn btn-success mt-3">Ir para o Perfil</a>
        </div>
    <?php else: ?>
        <div class="text-center">
            <a href="cadastro.html" class="btn btn-primary mt-3">Tentar Novamente</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
