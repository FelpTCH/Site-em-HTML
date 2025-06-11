<?php
ini_set('session.gc_maxlifetime', 86400); // Sessão válida por 24h
session_set_cookie_params(86400);
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

$mysqli = new mysqli("localhost", "root", "", "sabores");

// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "sabores");

if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Pega os dados do formulário, com valores padrão caso estejam vazios
    $titulo = $_POST['titulo'] ?? '';
    $ingredientes = $_POST['ingredientes'] ?? '';
    $preparo = $_POST['preparo'] ?? '';

    // Verifica se todos os campos estão preenchidos
    if (empty($titulo) || empty($ingredientes) || empty($preparo)) {
        die("Todos os campos são obrigatórios.");
    }

    // Prepara e executa a inserção
    $stmt = $mysqli->prepare("INSERT INTO receitas (titulo, ingredientes, preparo) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Erro ao preparar statement: " . $mysqli->error);
    }

    $stmt->bind_param("sss", $titulo, $ingredientes, $preparo);

    if ($stmt->execute()) {
        echo "Receita salva com sucesso!";
    } else {
        echo "Erro ao salvar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "";
}

$mysqli->close();
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Insira sua Receita</title>
  <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="assets/css/inserir.css" />
  <style>
     .custom-header {
  background: linear-gradient(90deg, #388e3c, #66bb6a);
  border-radius: 12px;
  margin: 10px;
  gap: 10px;
  flex-wrap: wrap;
  transition: background 0.4s ease;
}

.logo-img {
  height: 60px;
  width: auto;
}

.logo-text {
  font-family: 'Segoe UI', sans-serif;
  font-weight: 600;
}

.nav-links a {
  color: white;
  font-weight: 500;
  font-size: 1.1rem;
  text-decoration: none;
  position: relative;
  padding-bottom: 4px;
}

.nav-links a::after {
  content: "";
  display: block;
  width: 0;
  height: 2px;
  background: white;
  transition: width 0.3s;
  position: absolute;
  bottom: 0;
  left: 0;
}

.nav-links a:hover::after {
  width: 100%;
}

.search-box {
  flex-shrink: 1;
}

.search-input {
  border-radius: 20px;
  padding: 8px 16px;
  border: none;
  width: 220px;
  max-width: 100%;
  outline: none;
  transition: box-shadow 0.3s ease;
}

.search-input:focus {
  box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
}

@media (max-width: 768px) {
  .custom-header {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .nav-links {
    justify-content: center;
    gap: 1rem;
  }

  .search-box {
    margin-top: 10px;
  }
}

html, body {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
}
main {
  flex: 1;
}
   footer {
    background-color: #2e7d32
    }
    </style>
</head>

<body class="bg-light">

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

  <main class="container my-5">
    <h2 class="text-center mb-4">Compartilhe sua Receita</h2>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="inserir_receita.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm bg-white">
          <div class="mb-3">
            <label for="titulo" class="form-label">Título da Receita</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
          </div>
          <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" required>
          </div>
          <div class="mb-3">
            <label for="ingredientes" class="form-label">Ingredientes</label>
            <textarea class="form-control" id="ingredientes" name="ingredientes" rows="5" required></textarea>
          </div>
          <div class="mb-3">
            <label for="modo_preparo" class="form-label">Modo de Preparo</label>
            <textarea class="form-control" id="modo_preparo" name="modo_preparo" rows="5" required></textarea>
          </div>
          <div class="mb-3">
            <label for="foto" class="form-label">Imagem da Receita</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="foto/*">
          </div>
          <button type="submit" class="btn btn-success w-100">Inserir Receita</button>
          
        </form>
      </div>
    </div>
  </main>

<!-- Footer -->
<footer class="background-color text-white mt-3 p-3 text-center">
  <div class="text-center">
    <p class="mb-0">&copy; 2025 | Sabores e Temperos - Todos os direitos reservados.</p>
  </div>
  <small>Receitas com carinho para sua cozinha.</small>
</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
