<?php
// Configura o tempo de vida da sessão para 24 horas
ini_set('session.gc_maxlifetime', 86400); // 24h em segundos
session_set_cookie_params(86400);         // Cookie de sessão também válido por 24h
session_start();



// Conexão com o banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "sabores";

$conn = new mysqli($host, $usuario, $senha, $banco);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Captura os dados do formulário
$email = $_POST['email'] ?? '';
$senha_digitada = $_POST['senha'] ?? '';

// Prepara e executa a consulta
$sql = "SELECT id, nome, email, senha, foto FROM usuarios WHERE email = ?"; // <-- aqui adiciona 'foto'
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o usuário existe
if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    // Verifica a senha
    if (password_verify($senha_digitada, $usuario['senha'])) {
        // Salva os dados na sessão, incluindo a foto
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
            'foto' => $usuario['foto']   // <--- adiciona aqui
            
        ];

        // Redireciona para o perfil
        header("Location: perfil.php");
        exit();
    } else {
        // Senha incorreta
        $erro = "Senha incorreta.";
    }
} else {
    // Email não encontrado
    $erro = "Usuário não encontrado.";
}

$conn->close();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

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
            <a href="login.html " class="btn btn-primary mt-3">Tentar Novamente</a>
        </div>
    </div>
</body>
</html>
