<?php
ini_set('session.gc_maxlifetime', 86400); // 24 horas em segundos
session_set_cookie_params(86400); // Cookie válido por 24 horas
session_start();
$mysqli = new mysqli("localhost", "root", "", "sabores");

if ($mysqli->connect_error) {
  die("Erro na conexão: " . $mysqli->connect_error);
}

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$ingredientes = $_POST['ingredientes'];
$modo_preparo = $_POST['modo_preparo'];

// Verifica se a imagem foi enviada
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $nome_foto = basename($_FILES['foto']['name']);
    $nome_foto = str_replace(' ', '_', $nome_foto); // substitui espaços por underline
    $caminho_foto = "uploads/" . $nome_foto;  // <== ponto e vírgula aqui

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_foto)) {
        // Insere no banco
        $stmt = $mysqli->prepare("INSERT INTO receitas (titulo, descricao, ingredientes, modo_preparo, foto) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $titulo, $descricao, $ingredientes, $modo_preparo, $nome_foto);  // usa $nome_foto aqui

if ($stmt->execute()) {
            $tipoAlerta = "success";
            $tituloMsg = "Receita salva com sucesso!";
            $mensagem = "Sua receita foi cadastrada e estará disponível em breve.";
        } else {
            $tipoAlerta = "danger";
            $tituloMsg = "Erro ao salvar a receita";
            $mensagem = "Erro: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $tipoAlerta = "danger";
        $tituloMsg = "Erro no upload da imagem";
        $mensagem = "Não foi possível mover a imagem para a pasta uploads.";
    }
} else {
    $tipoAlerta = "danger";
    $tituloMsg = "Erro no upload da imagem";
    $mensagem = "Por favor, envie uma imagem válida para a receita.";
}

$mysqli->close();
$redireciona = "5;url=inserir.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro | Sabores e Temperos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta http-equiv="refresh" content="<?php echo $redireciona; ?>">
  <style>
    body {
      background-color: #f6fff7;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    main {
      flex-grow: 1;
    }
  </style>
</head>
<body>

<header class="bg-success text-white text-center py-3 shadow-sm">
  <h1 class="mb-0">Sabores e Temperos</h1>
</header>

<main class="container my-5 d-flex justify-content-center align-items-center">
  <div class="alert alert-<?php echo $tipoAlerta; ?> shadow text-center" style="max-width: 600px; width: 100%;">
    <h4>
      <?php 
      echo ($tipoAlerta === "success") ? "&#127829; " : "&#9888; "; // bolo ou alerta
      echo $tituloMsg; 
      ?>
    </h4>
    <p class="mb-0"><?php echo $mensagem; ?></p>
    <small class="text-muted d-block mt-3">Você será redirecionado para a página de cadastro em 5 segundos...</small>
    <a href="inserir.php" class="btn btn-outline-success mt-3">Voltar agora</a>
  </div>
</main>

<footer class="bg-success text-white text-center py-3 mt-auto shadow-sm">
  <p class="mb-0">&copy; 2025 | Sabores e Temperos - Todos os direitos reservados.</p>
  <small>Receitas com carinho para sua cozinha.</small>
</footer>

</body>
</html>
