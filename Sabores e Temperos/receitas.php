<?php
ini_set('session.gc_maxlifetime', 86400); // 24 horas
session_set_cookie_params(86400); // cookie válido por 24h
session_start();

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "sabores"); // ajuste os dados se necessário
if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM receitas ORDER BY id DESC";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Receitas | Site de Receitas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  
    
  <head>
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
    
    body {
      background-color: #f4fdf5;
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar {
      background-color: #2e7d32 !important;
      border-radius: 0 0 12px 12px;
    }

    .navbar-brand, .nav-link {
      color: #ffffff !important;
    }

    .nav-link.active {
      font-weight: bold;
      text-decoration: underline;
    }

    header {
      background: linear-gradient(90deg, #a5d6a7, #81c784);
      border-radius: 12px;
    }

    .card {
      border-radius: 16px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0, 128, 0, 0.2);
    }

    .card-img-top {
      border-radius: 16px 16px 0 0;
      height: 200px;
      object-fit: cover;
    }

    .card-title {
      color: #2e7d32;
    }

    .btn-primary {
      background-color: #66bb6a;
      border: none;
      border-radius: 8px;
    }

    .btn-primary:hover {
      background-color: #388e3c;
    }
    html, body {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
}

.btn-success {
    background-color: #3cb371;
    border-color: #3cb371;
    border-radius: 8px;
    color: white;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    transition: background-color 0.3s ease;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-success:hover {
    background-color: #2e8b57;
    border-color: #2e8b57;
    color: white;
}

main {
  flex: 1;
}
    footer {
      background-color: #1b5e20;
      border-radius: 12px 12px 0 0;
    }

  </style>
</head>
<body>
  
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


<header 
class="bg-light py-4 mb-4">
  <div class="container text-center">
    <h1 class="display-5">Todas as Receitas</h1>
    <p class="lead">Confira nossas receitas deliciosas!</p>
  </div>
</header>

<section class="pb-5">
  <div class="container">
    <div class="row g-4">
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded">
              <img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>" 
                   class="card-img-top" 
                   alt="<?php echo htmlspecialchars($row['titulo']); ?>">
              <div class="card-body">
                <h5 class="card-title">
                  <?php echo htmlspecialchars($row['titulo']); ?>
                </h5>
                <p class="card-text">
                  <?php 
                    $descricao = strip_tags($row['descricao']);
                    echo htmlspecialchars(strlen($descricao) > 90 ? substr($descricao, 0, 90) . '...' : $descricao);
                  ?>
                </p>
                <a href="GOAT.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Ver Receita</a>

              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="col-12">
          <p class="text-center">Nenhuma receita encontrada.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>



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
