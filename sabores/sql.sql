-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS receitas_db;
USE receitas_db;

-- Tabela de Usuários
CREATE TABLE usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuarios VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Receitas
CREATE TABLE receitas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    ingredientes TEXT NOT NULL,
    instrucoes TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabela de Comentários
CREATE TABLE comentarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    recipe_id INT NOT NULL,
    user_id INT NOT NULL,
    comentario TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabela de Avaliações
CREATE TABLE avaliacao (
    id INT PRIMARY KEY AUTO_INCREMENT,
    recipe_id INT NOT NULL,
    user_id INT NOT NULL,
    avaliacoes TINYINT CHECK(rating BETWEEN 1 AND 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
