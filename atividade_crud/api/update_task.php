<?php
// api/update_task.php - atualiza tarefa (status ou descrição)
require_once '../db.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if(!isset($data['id_tarefa'])){
    http_response_code(400);
    echo json_encode(['error'=>'ID da tarefa ausente']);
    exit;
}
$fields = [];
$params = [];
$types = '';
if(isset($data['status'])){
    $fields[] = 'status=?';
    $params[] = $data['status'];
    $types .= 's';
}
if(isset($data['descricao'])){
    $fields[] = 'descricao=?';
    $params[] = $data['descricao'];
    $types .= 's';
}
if(!$fields){
    http_response_code(400);
    echo json_encode(['error'=>'Nada para atualizar']);
    exit;
}
$params[] = $data['id_tarefa'];
$types .= 'i';
$sql = 'UPDATE tarefas SET '.implode(',', $fields).' WHERE id_tarefa=?';
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
if($stmt->execute()){
    echo json_encode(['success'=>true]);
}else{
    http_response_code(500);
    echo json_encode(['error'=>'Erro ao atualizar']);
}
?>
