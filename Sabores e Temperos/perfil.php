<?php
// Iniciar a sessão e verificar se o usuário está logado
session_start();

if (!isset($_SESSION['usuario']) || !is_array($_SESSION['usuario'])) {
  header("Location: login.html");
  exit();
}

$usuario = $_SESSION['usuario']; // agora está garantido

$usuario = $_SESSION['usuario']; // Ex: $_SESSION['usuario'] = ['nome' => 'João', 'email' => 'joao@email.com'];

// Define a foto do usuário ou uma imagem padrão
$foto = isset($usuario['foto']) && !empty($usuario['foto']) 
    ? $usuario['foto'] 
    : 'assets/images/default-profile.png';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Perfil do Usuário</title>
  <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="assets/css/style.css" />

  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      flex: 1;
    }

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

    .perfil-box {
      background-color: #ffffff;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
      max-width: 720px;
      width: 100%;
    }

    .perfil-box:hover {
      transform: translateY(-4px);
    }

    .perfil-label {
      font-weight: 600;
      color: #2e7d32;
      display: inline-block;
      min-width: 80px;
    }

    .perfil-box p {
      font-size: 1.1rem;
      margin-bottom: 15px;
    }

    .perfil-box h2 {
      color: #388e3c;
      font-weight: bold;
    }

    .btn-outline-success {
      padding: 10px 25px;
      font-size: 1rem;
      border-radius: 50px;
    }

    @media (max-width: 576px) {
      .perfil-box {
        padding: 30px 20px;
      }

      .perfil-box p {
        font-size: 1rem;
      }

      .btn-outline-success {
        width: 100%;
      }
    }

    footer {
      background-color: #2e7d32;
    }

    .foto-perfil {
  width: 140px;
  height: 140px;
  object-fit: cover;
  border-radius: 50%;
  border: 3px solid #2e7d32;
  margin-bottom: 20px;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

  </style>
</head>


  </style>
</head>

  </style>
</head>
<body class="bg-light">

<header class="custom-header d-flex align-items-center justify-content-between flex-wrap px-5 py-3 shadow">
  <a href="index.html" class="d-flex align-items-center gap-2 text-decoration-none">
    <img src="assets/images/logo.png" alt="Logo do site" class="logo-img">
    <h1 class="logo-text m-0 text-white fs-4">Sabores e Temperos</h1>
  </a>

  <nav class="nav-links d-flex gap-4 flex-wrap justify-content-center">
    <a href="index.html" class="nav-link">Início</a>
    <a href="inserir.html" class="nav-link">Insira sua receita</a>
    <a href="perfil.php" class="nav-link">Perfil</a>
    <a href="logout.php" class="nav-link">Sair</a>
  </nav>

  <div class="search-box mt-2 mt-md-0">
    <input type="text" placeholder="Buscar receitas..." class="form-control search-input">
  </div>
</header>
<main class="flex-grow-1">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 perfil-box text-center">
        <img src="<?= htmlspecialchars($foto) ?>" alt="Foto do usuário" class="foto-perfil mb-4" />
        <h2 class="mb-4">Meu Perfil</h2>
        <p><span class="perfil-label">Nome:</span> <?= htmlspecialchars($usuario['nome']) ?></p>
        <p><span class="perfil-label">E-mail:</span> <?= htmlspecialchars($usuario['email']) ?></p>
        <div class="mt-4">
          <a href="editar_perfil.php" class="btn btn-outline-success">Editar Perfil</a>
        </div>
      </div>
    </div>
  </div>
</main>



<footer class="text-white mt-5 p-3 text-center">
  <p class="mb-0">&copy; 2025 | Sabores e Temperos - Todos os direitos reservados.</p>
  <small>Receitas com carinho para sua cozinha.</small>
</footer>

</body>
</html>
