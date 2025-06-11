<?php
// buscar.php
session_start();

$mysqli = new mysqli("localhost", "root", "", "sabores");
if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}

$termo = $_GET['q'] ?? '';
$termo = trim($termo);

$receitas = [];

if ($termo !== '') {
    // Pesquisa pelo título usando LIKE para busca parcial
    $sql = "SELECT id, titulo, descricao, foto FROM receitas WHERE titulo LIKE ?";
    $stmt = $mysqli->prepare($sql);
    $likeTermo = "%{$termo}%";
    $stmt->bind_param("s", $likeTermo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($row = $resultado->fetch_assoc()) {
        $receitas[] = $row;
    }

    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escondidinho de Carne - Site de Receitas</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        html, body {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
}

body {
  background-color: #f6fff7;
  /* outros estilos */
}

.container {
  flex: 1 0 auto; /* conteúdo principal expande e empurra o footer para baixo */
}

footer {
  flex-shrink: 0; /* footer não encolhe */
  background-color: #2e7d32 !important;
  color: #c9f7c4 !important;
  text-align: center;
  padding: 1rem 0;
  border-radius: 0 0 12px 12px;
}

    </style>
</head>
<body>

<!-- Navbar -->
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
  <form action="buscar.php" method="GET">
    <input
      type="text"
      name="q"
      placeholder="Buscar receitas..."
      class="form-control search-input"
      autocomplete="off"
    />
  </form>
</div>
  </header>

<div class="container my-5">
  <h3>Resultados para: <em><?php echo htmlspecialchars($termo); ?></em></h3>
  
  <?php if (count($receitas) === 0): ?>
    <p>Nenhuma receita encontrada.</p>
  <?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($receitas as $r): ?>
        <div class="col">
          <div class="card h-100">
            <img src="<?php echo 'uploads/' . htmlspecialchars($r['foto']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($r['titulo']); ?>">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($r['titulo']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars(mb_strimwidth($r['descricao'], 0, 100, '...')); ?></p>
              <a href="goat.php?id=<?php echo $r['id']; ?>" class="btn btn-success">Ver receita</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>



<br><br><br><br><br>
<footer class="bg-success text-white text-center py-3 mt-5">
  <p class="mb-0">&copy; 2025 | Sabores e Temperos - Todos os direitos reservados.</p>
  <small>Receitas com carinho para sua cozinha.</small>
</footer>
</body>
</html>
