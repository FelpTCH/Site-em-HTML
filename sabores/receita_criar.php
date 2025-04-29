<?php
require 'db_link.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = 1; // ID de exemplo, ajuste para o usuário logado
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredientes = $_POST['ingredients'];
    $instrucoes = $_POST['instructions'];

    $stmt = $conn->prepare("INSERT INTO receitas (user_id, title, description, ingredientes, instrucoes) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $title, $description, $ingredientes, $instrucoes);

    if ($stmt->execute()) {
        echo "Receita cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar receita: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!-- Formulário de Receita -->
<form method="post">
    <label>Título:</label>
    <input type="text" name="title" required>
    <label>Descrição:</label>
    <textarea name="description" required></textarea>
    <label>Ingredientes:</label>
    <textarea name="ingredients" required></textarea>
    <label>Instruções:</label>
    <textarea name="instructions" required></textarea>
    <button type="submit">Salvar Receita</button>
</form>