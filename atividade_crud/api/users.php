<?php
// api/users.php - lista todos os usuários
require_once '../db.php';
header('Content-Type: application/json');
$res = $conn->query('SELECT id_usuario, nome, email FROM usuarios ORDER BY nome');
$users = [];
while($row = $res->fetch_assoc()) $users[] = $row;
echo json_encode($users);
?>
