<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receita - Sabores e Temperos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/header.css" />
    <style>
        body {
            background-color: #f6fff7;
        }
        .navbar, footer {
            background-color: #2e7d32 !important;
        }
        .nav-link, .navbar-brand, footer p {
            color: #c9f7c4 !important;
        }
        h1, h3 {
            color: #2e8b57;
        }
        .btn-success {
            background-color: #3cb371;
            border-color: #3cb371;
        }
        .btn-success:hover {
            background-color: #2e8b57;
        }
    </style>
</head>
<body>
<?php
$mysqli = new mysqli("localhost", "root", "", "sabores");
if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT * FROM receitas WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$receita = $result->fetch_assoc();
$stmt->close();
$mysqli->close();

if (!$receita) {
    echo '<div class="container mt-5"><h1>Receita não encontrada.</h1></div>'; exit;
}
?>

<header class="custom-header d-flex align-items-center justify-content-between flex-wrap px-5 py-3 shadow">
    <a href="index.php" class="d-flex align-items-center gap-2 text-decoration-none">
        <img src="assets/images/logo.png" alt="Logo do site" class="logo-img">
        <h1 class="logo-text m-0 text-white fs-4">Sabores e Temperos</h1>
    </a>

    <nav class="nav-links d-flex gap-4 flex-wrap justify-content-center">
        <a href="index.php" class="nav-link">Início</a>
        <a href="inserir.php" class="nav-link">Insira sua receita</a>
        <a href="cadastro.html" class="nav-link">Conta</a>
        <a href="perfil.php" class="nav-link">Perfil</a>
    </nav>

    <div class="search-box mt-2 mt-md-0">
        <input type="text" placeholder="Buscar receitas..." class="form-control search-input">
    </div>
</header>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="uploads/<?php echo htmlspecialchars($receita['foto']); ?>" 
              class="img-fluid rounded" 
             alt="<?php echo htmlspecialchars($receita['titulo']); ?>">
        </div>
        <div class="col-md-6">
            <h1><?php echo htmlspecialchars($receita['titulo']); ?></h1>
            <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($receita['descricao'])); ?></p>

            <h3>Ingredientes:</h3>
            <p><?php echo nl2br(htmlspecialchars($receita['ingredientes'])); ?></p>

            <h3>Modo de Preparo:</h3>
            <p><?php echo nl2br(htmlspecialchars($receita['modo_preparo'])); ?></p>

            <a href="receitas.php" class="btn btn-secondary mt-3">Voltar às receitas</a>
        </div>
    </div>
</div>

<footer class="background-color text-white mt-3 p-3 text-center">
    <div class="text-center">
        <p class="mb-0">&copy; 2025 | Sabores e Temperos - Todos os direitos reservados.</p>
    </div>
    <small>Receitas com carinho para sua cozinha.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
