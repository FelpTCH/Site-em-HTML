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
    <title>Pudim de Leite - Site de Receitas</title>
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
      <input type="text" placeholder="Buscar receitas..." class="form-control search-input">
    </div>
  </header>

<!-- Página da Receita -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="assets/images/pudim.png" class="img-fluid" alt="Pudim de Leite">
        </div>
        <div class="col-md-6">
            <h1>Pudim de Leite</h1>
            <p><strong>Descrição:</strong> Um clássico da sobremesa brasileira, com uma textura cremosa e sabor irresistível. Perfeito para qualquer ocasião.</p>

            <h3>Ingredientes:</h3>
            <ul>
                <li>1 lata de leite condensado</li>
                <li>2 latas de leite (use a lata do leite condensado como medida)</li>
                <li>3 ovos</li>
                <li>1 xícara de açúcar</li>
                <li>1 colher de sopa de água</li>
                <li>1 colher de chá de essência de baunilha (opcional)</li>
            </ul>

            <h3>Modo de Preparo:</h3>
            <ol>
                <li>Primeiro, faça o caramelo: em uma panela, derreta o açúcar com a água até formar um caramelo dourado. Despeje o caramelo em uma forma de pudim.</li>
                <li>Para o pudim, bata no liquidificador o leite condensado, o leite, os ovos e a baunilha até ficar bem misturado.</li>
                <li>Despeje a mistura na forma caramelizada e cubra com papel alumínio.</li>
                <li>Asse em banho-maria no forno preaquecido a 180°C por cerca de 1 hora e 15 minutos, ou até o pudim firmar.</li>
                <li>Deixe esfriar e desenforme. Sirva gelado!</li>
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
