<?php
// api/task.php - busca tarefa específica
require_once '../db.php';
header('Content-Type: application/json');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if(!$id){
    http_response_code(400);
    echo json_encode(['error'=>'ID ausente']);
    exit;
}
$sql = 'SELECT t.*, u.nome FROM tarefas t JOIN usuarios u ON t.id_usuario = u.id_usuario WHERE t.id_tarefa=?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
if($row = $res->fetch_assoc()){
    echo json_encode($row);
}else{
    http_response_code(404);
    echo json_encode(['error'=>'Tarefa não encontrada']);
}
?>
