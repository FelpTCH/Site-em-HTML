<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: cadastro.html");
    exit;
}

if (!isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['confirmaSenha'])) {
    die("Dados incompletos. Por favor, volte e preencha todos os campos.");
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senhaOriginal = $_POST['senha'];
$senhaConfirmada = $_POST['confirmaSenha'];

if ($senhaOriginal !== $senhaConfirmada) {
    $mensagem = "As senhas não coincidem. <a href='cadastro.html' class='alert-link'>Tente novamente</a>.";
    $sucesso = false;
    goto mostrarMensagem;
}

$senha = password_hash($senhaOriginal, PASSWORD_DEFAULT);


$host = "localhost";
$db = "sabores";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Verifica se o e-mail já existe
$verifica = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$verifica->bind_param("s", $email);
$verifica->execute();
$verifica->store_result();

$mensagem = "";
$sucesso = false;

if ($verifica->num_rows > 0) {
    $mensagem = "Este e-mail já está cadastrado. <a href='cadastro.html' class='alert-link'>Tente outro</a>.";
} else {
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        $_SESSION['usuario_id'] = $stmt->insert_id;
        $mensagem = "Cadastro realizado com sucesso! Você será redirecionado em instantes.";
        $sucesso = true;
    } else {
        $mensagem = "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
}

$verifica->close();
$conn->close();
mostrarMensagem:
?>

<!-- HTML abaixo usa Bootstrap -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro | Sabores e Temperos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta http-equiv="refresh" content="<?= $sucesso ? '3;url=perfil.php' : '10' ?>">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

  <!-- Header -->
  <header class="bg-success text-white text-center py-3">
    <h1 class="mb-0">Sabores e Temperos</h1>
  </header>

  <!-- Mensagem principal -->
  <main class="flex-grow-1 container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="alert <?= $sucesso ? 'alert-success' : 'alert-danger' ?> text-center shadow">
          <?= $mensagem ?>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-success text-white text-center py-3 mt-auto">
    <p class="mb-0">&copy; 2025 | Sabores e Temperos - Todos os direitos reservados.</p>
    <small>Receitas com carinho para sua cozinha.</small>
  </footer>

</body>
</html>
