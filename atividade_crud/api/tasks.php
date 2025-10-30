<?php
// api/tasks.php - lista todas as tarefas com dados do usuário
require_once '../db.php';
header('Content-Type: application/json');
$sql = 'SELECT t.id_tarefa, t.descricao, t.setor, t.prioridade, t.status, t.id_usuario, u.nome FROM tarefas t JOIN usuarios u ON t.id_usuario = u.id_usuario ORDER BY t.data_cadastro DESC';
$res = $conn->query($sql);
$tasks = [];
while($row = $res->fetch_assoc()) $tasks[] = $row;
echo json_encode($tasks);
?>
