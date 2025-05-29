CREATE DATABASE sabores_temperos;
USE sabores_temperos;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    receita_id INT NOT NULL,
    texto TEXT NOT NULL,
    data DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE favoritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    receita_id INT NOT NULL,
    data_adicionado DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE receitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    ingredientes TEXT,
    modo_preparo TEXT,
    imagem VARCHAR(255),
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);
