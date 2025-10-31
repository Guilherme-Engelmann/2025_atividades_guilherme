<?php
// includes/header.php
require_once __DIR__.'/auth.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Kanban CRUD</title>
  <link rel="stylesheet" href="/2025_atividades_guilherme/atividade_crud/assets/css/style.css">
</head>
<body>
  <div class="container">
    <header>
      <h1>Kanban CRUD</h1>
      <?php if(is_logged_in()): ?>
      <nav>
        <a href="/2025_atividades_guilherme/atividade_crud/tarefas/listar.php">Painel Kanban</a>
        <a href="/2025_atividades_guilherme/atividade_crud/tarefas/criar.php">Nova Tarefa</a>
        <a href="/2025_atividades_guilherme/atividade_crud/logout.php">Logout</a>
      </nav>
      <?php endif; ?>
    </header>
