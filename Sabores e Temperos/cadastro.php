<?php
ini_set('session.gc_maxlifetime', 86400); // 24 horas
session_set_cookie_params(86400);
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

// Redireciona se não for POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: cadastro.html");
    exit;
}

// Validação de campos obrigatórios
if (!isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['confirmaSenha'])) {
    mostrarMensagem(false, "Dados incompletos. <a href='cadastro.html'>Tente novamente</a>.");
}

$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$senhaOriginal = $_POST['senha'];
$senhaConfirmada = $_POST['confirmaSenha'];

// Validações adicionais (importantes mesmo com JS)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    mostrarMensagem(false, "E-mail inválido. <a href='cadastro.html'>Tente novamente</a>.");
}

if (strlen($senhaOriginal) < 8) {
    mostrarMensagem(false, "A senha deve ter pelo menos 8 caracteres. <a href='cadastro.html'>Corrigir</a>.");
}

if ($senhaOriginal !== $senhaConfirmada) {
    mostrarMensagem(false, "As senhas não coincidem. <a href='cadastro.html'>Corrigir</a>.");
}

$senhaHash = password_hash($senhaOriginal, PASSWORD_DEFAULT);

// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "sabores");
if ($conn->connect_error) {
    mostrarMensagem(false, "Erro de conexão com o banco de dados.");
}

// Verifica se o e-mail já está cadastrado
$verifica = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$verifica->bind_param("s", $email);
$verifica->execute();
$verifica->store_result();

if ($verifica->num_rows > 0) {
    mostrarMensagem(false, "Este e-mail já está cadastrado. <a href='cadastro.html'>Tente outro</a>.");
}
$verifica->close();

// Insere novo usuário
$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senhaHash);

if ($stmt->execute()) {
    $_SESSION['usuario_id'] = $conn->insert_id;  // Corrigido aqui
    $stmt->close();
    $conn->close();
    mostrarMensagem(true, "Cadastro realizado com sucesso! Você será redirecionado em instantes.<a href='perfil.php'>");
}  else {
    $erro = $stmt->error;
    $stmt->close();
    $conn->close();
    mostrarMensagem(false, "Erro ao cadastrar: $erro");
}

// Função para exibir mensagem final
function mostrarMensagem($sucesso, $mensagem) {
    $tipoAlerta = $sucesso ? 'success' : 'danger';
    $redireciona = $sucesso ? '3;url=index.php' : '10';

session_unset();     // Limpa todas as variáveis da sessão
session_destroy();   // Encerra a sessão

    echo <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro | Sabores e Temperos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta http-equiv="refresh" content="$redireciona">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<header class="bg-success text-white text-center py-3">
  <h1 class="mb-0">Sabores e Temperos</h1>
</header>

<main class="flex-grow-1 container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="alert alert-$tipoAlerta text-center shadow">
        $mensagem
      </div>
    </div>
  </div>
</main>

<footer class="bg-success text-white text-center py-3 mt-auto">
  <p class="mb-0">&copy; 2025 | Sabores e Temperos - Todos os direitos reservados.</p>
  <small>Receitas com carinho para sua cozinha.</small>
</footer>

</body>
</html>
HTML;
    exit;
}
?>
