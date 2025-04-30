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
  <a href="index.html" class="d-flex align-items-center gap-2 text-decoration-none">
    <img src="assets/images/logo.png" alt="Logo do site" class="logo-img">
    <h1 class="logo-text m-0 text-white fs-4">Sabores e Temperos</h1>
  </a>

  <nav class="nav-links d-flex gap-4 flex-wrap justify-content-center">
    <a href="index.html" class="nav-link">Início</a>
    <a href="inserir.html" class="nav-link">Insira sua receita</a>
    <a href="cadastro.html" class="nav-link">Conta</a>
  </nav>

  <div class="search-box mt-2 mt-md-0">
    <input type="text" placeholder="Buscar receitas..." class="form-control search-input">
  </div>
</header>

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
        <div class="card h-100 shadow-sm rounded">
          <img src="assets/images/bolochoco.avif" class="card-img-top" alt="Bolo de Chocolate">
          <div class="card-body">
            <h5 class="card-title">Bolo de Chocolate</h5>
            <p class="card-text">Fofinho e com cobertura cremosa. Perfeito para sobremesas.</p>
            <a href="bolo.html" class="btn btn-green">Ver Receita</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm rounded">
          <img src="assets/images/lasanha.png" class="card-img-top" alt="Bolo de Chocolate">
          <div class="card-body">
            <h5 class="card-title">Lasanha de Carne</h5>
            <p class="card-text">Molho caseiro, massa macia e queijo derretido.</p>
            <a href="lasanha.html" class="btn btn-green">Ver Receita</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm rounded">
          <img src="assets/images/salada.png" class="card-img-top" alt="Bolo de Chocolate">
          <div class="card-body">
            <h5 class="card-title">Salada Refrescante</h5>
            <p class="card-text">Leve, saudável e cheia de sabor. Ideal para o verão.</p>
            <a href="salada.html" class="btn btn-green">Ver Receita</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm rounded">
          <img src="assets/images/panqueca.png" class="card-img-top" alt="Bolo de Chocolate">
          <div class="card-body">
            <h5 class="card-title">Panqueca Recheada</h5>
            <p class="card-text">Recheada com carne moída e molho especial.</p>
            <a href="panqueca.html" class="btn btn-green">Ver Receita</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm rounded">
          <img src="assets/images/pudim.png" class="card-img-top" alt="Bolo de Chocolate">
          <div class="card-body">
            <h5 class="card-title">Pudim de Leite</h5>
            <p class="card-text">Tradicional, cremoso e com calda de caramelo.</p>
            <a href="pudim.html" class="btn btn-green">Ver Receita</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm rounded">
          <img src="assets/images/rondelli.png" class="card-img-top" alt="Bolo de Chocolate">
          <div class="card-body">
            <h5 class="card-title">Rondelli ao Molho Branco</h5>
            <p class="card-text">Recheado com presunto e queijo, coberto com molho branco.</p>
            <a href="rondelli.html" class="btn btn-green">Ver Receita</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm rounded">
          <img src="assets/images/feijoada.png" class="card-img-top" alt="Bolo de Chocolate">
          <div class="card-body">
            <h5 class="card-title">Feijoada Completa</h5>
            <p class="card-text">Tradicional prato brasileiro com carnes e feijão preto.</p>
            <a href="feijoada.html" class="btn btn-green">Ver Receita</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm rounded">
          <img src="assets/images/frango assado.png" class="card-img-top" alt="Bolo de Chocolate">
          <div class="card-body">
            <h5 class="card-title">Frango Assado</h5>
            <p class="card-text">Frango temperado assado com batatas douradas.</p>
            <a href="frango.html" class="btn btn-green">Ver Receita</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm rounded">
          <img src="assets/images/escondidinho.png" class="card-img-top" alt="Bolo de Chocolate">
          <div class="card-body">
            <h5 class="card-title">Escondidinho de Carne</h5>
            <p class="card-text">Com purê de batata e carne seca desfiada.</p>
            <a href="escondidinho.html" class="btn btn-green">Ver Receita</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm rounded">
          <img src="assets/images/tortamaca.png" class="card-img-top" alt="Bolo de Chocolate">
          <div class="card-body">
            <h5 class="card-title">Torta de Maçã</h5>
            <p class="card-text">Clássica torta americana com toque de canela.</p>
            <a href="torta.html" class="btn btn-green">Ver Receita</a>
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
