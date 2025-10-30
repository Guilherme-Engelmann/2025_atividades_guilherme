<?php
// api/delete_task.php - exclui tarefa
require_once '../db.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if(!isset($data['id_tarefa'])){
    http_response_code(400);
    echo json_encode(['error'=>'ID da tarefa ausente']);
    exit;
}
$stmt = $conn->prepare('DELETE FROM tarefas WHERE id_tarefa=?');
$stmt->bind_param('i', $data['id_tarefa']);
if($stmt->execute()){
    echo json_encode(['success'=>true]);
}else{
    http_response_code(500);
    echo json_encode(['error'=>'Erro ao excluir']);
}
?>
