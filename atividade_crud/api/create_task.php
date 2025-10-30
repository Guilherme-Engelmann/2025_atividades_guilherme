<?php
// api/create_task.php - cadastra nova tarefa
require_once '../db.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if(!isset($data['id_usuario'], $data['descricao'], $data['setor'], $data['prioridade'])){
    http_response_code(400);
    echo json_encode(['error'=>'Dados obrigatórios ausentes']);
    exit;
}
$status = 'a fazer';
$stmt = $conn->prepare('INSERT INTO tarefas (id_usuario, descricao, setor, prioridade, status) VALUES (?, ?, ?, ?, ?)');
$stmt->bind_param('issss', $data['id_usuario'], $data['descricao'], $data['setor'], $data['prioridade'], $status);
if($stmt->execute()){
    echo json_encode(['success'=>true]);
}else{
    http_response_code(500);
    echo json_encode(['error'=>'Erro ao cadastrar tarefa']);
}
?>
