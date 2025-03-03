CREATE DATABASE pinkvulvet;
USE pinkvulvet;

CREATE TABLE usuarios (
    id_usuario INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(60) NOT NULL
);

CREATE TABLE categoria (
    id_categoria INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL 
);

CREATE TABLE produto (
    id_produto INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_categoria INT(5) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    nome VARCHAR(50),
    descricao VARCHAR(200),
    imagem VARCHAR(200),
    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria)
);

CREATE TABLE endereco (
    cpf INT(11) NOT NULL PRIMARY KEY,
    cep INT(8),
    nome_rua VARCHAR(100) NOT NULL,
    numero_casa INT,
    estado VARCHAR(30) NOT NULL,
    cidade VARCHAR(30) NOT NULL,
    bairro VARCHAR(30) NOT NULL,
    informacoes VARCHAR(150),
    telefone VARCHAR(15) NOT NULL,
    nome VARCHAR(70) NOT NULL,
    id_usuario INT(5) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE pedido (
    id_pedido INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT(5) NOT NULL,
    valor_total DECIMAL(10, 2) NOT NULL,
    data_pedido DATE NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE pagamento (
    id_pagamento INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_pedido INT(5) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    forma_pagamento VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido)
);

CREATE TABLE item_pedido (
    id_item INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_pedido INT(5) NOT NULL,
    id_produto INT(5) NOT NULL,
    quantidade INT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido),
    FOREIGN KEY (id_produto) REFERENCES produto(id_produto)
);
