<?php
ini_set('session.gc_maxlifetime', 86400); // 24 horas
session_set_cookie_params(86400); // cookie válido por 24h
session_start();

// conexão com o banco
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "sabores";

$conn = new mysqli($host, $usuario, $senha, $banco);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$email = $_POST['email'] ?? '';
$senha_digitada = $_POST['senha'] ?? '';

$sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    if (password_verify($senha_digitada, $usuario['senha'])) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email']
        ];

        header("Location: perfil.php");
        exit();
    } else {
        $erro = "Senha incorreta.";
    }
} else {
    $erro = "Usuário não encontrado.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Erro no Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-5">
        <h2 class="text-danger text-center">Erro no Login</h2>
        <p class="text-center"><?php echo $erro; ?></p>
        <div class="text-center">
            <a href="login.html" class="btn btn-primary mt-3">Tentar Novamente</a>
        </div>
    </div>
</body>
</html>
