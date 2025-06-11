<?php
ini_set('session.gc_maxlifetime', 86400); // 24 horas
session_set_cookie_params(86400); // cookie válido por 24h
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feijoada Completa - Site de Receitas</title>
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


<!-- Página da Receita -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="assets/images/feijoada.png" class="img-fluid" alt="Feijoada Completa">
        </div>
        <div class="col-md-6">
            <h1>Feijoada Completa</h1>
            <p><strong>Descrição:</strong> Tradicional prato brasileiro feito com feijão preto e carnes variadas. Uma refeição rica e saborosa, ideal para reuniões em família.</p>

            <h3>Ingredientes:</h3>
            <ul>
                <li>500g de feijão preto</li>
                <li>200g de carne seca</li>
                <li>200g de costelinha de porco</li>
                <li>100g de paio</li>
                <li>100g de linguiça calabresa</li>
                <li>1 cebola picada</li>
                <li>2 dentes de alho picados</li>
                <li>2 folhas de louro</li>
                <li>Sal e pimenta a gosto</li>
                <li>Água suficiente para o cozimento</li>
            </ul>

            <h3>Modo de Preparo:</h3>
            <ol>
                <li>Deixe as carnes salgadas de molho por 12h, trocando a água algumas vezes.</li>
                <li>Cozinhe o feijão com as folhas de louro até ficar macio.</li>
                <li>Em outra panela, refogue alho e cebola, adicione as carnes e doure.</li>
                <li>Junte as carnes ao feijão e cozinhe até tudo estar bem macio.</li>
                <li>Ajuste o sal, sirva com arroz branco, couve refogada e farofa.</li>
            </ol>

            <a href="receitas.php" class="btn btn-secondary mt-3">Voltar às receitas</a>
        </div>
    </div>
</div>

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
