<?php
session_start();

if (!isset($_SESSION['usuario']) || !is_array($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

$usuario = $_SESSION['usuario'];
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_nome = trim($_POST['nome']);
    $novo_email = trim($_POST['email']);

    // Dados da conexão
    $conn = new mysqli("localhost", "root", "", "sabores");
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Caminho da foto atual ou null
    $caminho_foto = $usuario['foto'] ?? null;

    // Upload da imagem, se enviado
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $nomeTmp = $_FILES['foto']['tmp_name'];
        $nomeArquivo = basename($_FILES['foto']['name']);
        $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
        $permitidos = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($extensao, $permitidos)) {
            $pastaUploads = 'uploads/';

            // Criar a pasta caso não exista
            if (!is_dir($pastaUploads)) {
                mkdir($pastaUploads, 0755, true);
            }

            $novoNomeArquivo = uniqid() . '.' . $extensao;

            if (move_uploaded_file($nomeTmp, $pastaUploads . $novoNomeArquivo)) {
                $caminho_foto = $pastaUploads . $novoNomeArquivo;
            } else {
                $erro = "Erro ao salvar a imagem.";
            }
        } else {
            $erro = "Formato de imagem não permitido. Use jpg, png ou gif.";
        }
    }

    if (!$erro) {
        $sql = "UPDATE usuarios SET nome = ?, email = ?, foto = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $novo_nome, $novo_email, $caminho_foto, $usuario['id']);

        if ($stmt->execute()) {
            $_SESSION['usuario']['nome'] = $novo_nome;
            $_SESSION['usuario']['email'] = $novo_email;
            $_SESSION['usuario']['foto'] = $caminho_foto;
            header("Location: perfil.php");
            exit();
        } else {
            $erro = "Erro ao atualizar perfil.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Perfil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .perfil-box {
      max-width: 720px;
      margin: 50px auto;
      background: white;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }
    .perfil-label {
      font-weight: 600;
      color: #2e7d32;
    }
    img.foto-atual {
      display: block;
      margin: 0 auto 20px auto;
      width: 140px;
      height: 140px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #2e7d32;
    }
    .btn-outline-success {
      padding: 10px 25px;
      font-size: 1rem;
      border-radius: 50px;
    }
  </style>
</head>
<body>

  <main>
    <div class="perfil-box">
      <h2 class="text-center mb-4">Editar Perfil</h2>

      <?php if ($erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
      <?php endif; ?>

      <?php
      $foto_atual = $usuario['foto'] ?? 'assets/images/default-profile.png';
      ?>
      <img src="<?= htmlspecialchars($foto_atual) ?>" alt="" class="foto-atual">

      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="nome" class="form-label perfil-label">Nome</label>
          <input type="text" id="nome" name="nome" class="form-control" required value="<?= htmlspecialchars($usuario['nome']) ?>">
        </div>

        <div class="mb-3">
          <label for="email" class="form-label perfil-label">E-mail</label>
          <input type="email" id="email" name="email" class="form-control" required value="<?= htmlspecialchars($usuario['email']) ?>">
        </div>

        <div class="mb-4">
          <label for="foto" class="form-label perfil-label">Alterar Foto</label>
          <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-outline-success">Salvar Alterações</button>
          <a href="perfil.php" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
      </form>
    </div>
  </main>

</body>
</html>
