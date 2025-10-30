-- Script SQL para criar as tabelas do Kanban
CREATE DATABASE IF NOT EXISTS gerenciador_kanban;
USE gerenciador_kanban;

CREATE TABLE IF NOT EXISTS usuarios (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS tarefas (
  id_tarefa INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  descricao TEXT NOT NULL,
  setor VARCHAR(100) NOT NULL,
  prioridade ENUM('baixa','media','alta') NOT NULL DEFAULT 'media',
  data_cadastro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status ENUM('a fazer','fazendo','pronto') NOT NULL DEFAULT 'a fazer',
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE
);
