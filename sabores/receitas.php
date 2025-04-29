<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Receitas | Site de Receitas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Header simples -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Site de Receitas</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
        <li class="nav-item"><a class="nav-link active" href="receitas.php">Receitas</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Título da página -->
<header class="bg-light py-4 mb-4">
  <div class="container text-center">
    <h1 class="display-5">Todas as Receitas</h1>
    <p class="lead">Confira nossas receitas deliciosas!</p>
  </div>
</header>

<!-- Seção de receitas -->
<section class="pb-5">
  <div class="container">
    <div class="row g-4">
      <!-- Copie os mesmos 10 cards que estavam na index, vou deixar os primeiros 2 aqui como exemplo: -->

      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <img src="imagens/bolo-chocolate.jpg" class="card-img-top" alt="Bolo de Chocolate">
          <div class="card-body">
            <h5 class="card-title">Bolo de Chocolate</h5>
            <p class="card-text">Fofinho e com cobertura cremosa. Perfeito para sobremesas.</p>
            <a href="receita.php?id=1" class="btn btn-primary">Ver Receita</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <img src="imagens/lasanha.jpg" class="card-img-top" alt="Lasanha de Carne">
          <div class="card-body">
            <h5 class="card-title">Lasanha de Carne</h5>
            <p class="card-text">Molho caseiro, massa macia e queijo derretido.</p>
            <a href="receita.php?id=2" class="btn btn-primary">Ver Receita</a>
          </div>
        </div>
      </div>

      <!-- Continue com os demais cards aqui... -->
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white mt-5 p-4 text-center">
  <div class="container">
    <p class="mb-0">&copy; 2025 Gabriel | Site de Receitas</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
