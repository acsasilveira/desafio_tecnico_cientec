
-- Cria o banco de dados caso ainda não exista.
CREATE DATABASE IF NOT EXISTS sistema_cidadao
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

-- Seleciona o banco de dados.
USE sistema_cidadao;

-- Cria a tabela de cidadãos.
CREATE TABLE IF NOT EXISTS cidadaos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    cpf CHAR(11) NOT NULL UNIQUE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;
