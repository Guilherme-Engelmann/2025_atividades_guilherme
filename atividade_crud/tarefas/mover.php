<?php
require_once '../includes/auth.php';
require_login();
require_once '../includes/db.php';
$id = intval($_POST['id'] ?? 0);
$status = $_POST['status'] ?? 'A Fazer';
$usuario_id = $_SESSION['usuario_id'];
$stmt = $pdo->prepare('UPDATE tarefas SET status=? WHERE id=? AND usuario_id=?');
$stmt->execute([$status, $id, $usuario_id]);
header('Location: listar.php');
exit;
?>
