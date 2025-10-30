<?php
// api/create_user.php - cadastra novo usuário
require_once '../db.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if(!isset($data['nome'], $data['email'])){
    http_response_code(400);
    echo json_encode(['error'=>'Dados obrigatórios ausentes']);
    exit;
}
$stmt = $conn->prepare('INSERT INTO usuarios (nome, email) VALUES (?, ?)');
$stmt->bind_param('ss', $data['nome'], $data['email']);
if($stmt->execute()){
    echo json_encode(['success'=>true]);
}else{
    http_response_code(500);
    echo json_encode(['error'=>'Erro ao cadastrar']);
}
?>
