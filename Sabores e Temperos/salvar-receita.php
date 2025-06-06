<?php
ini_set('session.gc_maxlifetime', 86400); // 24 horas em segundos
session_set_cookie_params(86400); // Cookie válido por 24 horas
session_start();
//  futuramente no banco de dados...

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="3;URL=inserir.html">
  <title>Receita Salva</title>
  <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/inserir.css">
</head>
<body class="bg-light">

  <!-- MENSAGEM -->
  <main class="container d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
      <h2 class="text-success">Receita salva com sucesso!</h2>
      <p>Você será redirecionado em instantes...</p>
      <a href="inserir.html" class="btn btn-outline-success mt-3">Voltar agora</a>
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="text-white mt-3 p-3 text-center" style="background-color: #2e7d32;">
    <p class="mb-0">&copy; 2025 | Sabores e Temperos - Todos os direitos reservados.</p>
    <small>Receitas com carinho para sua cozinha.</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

