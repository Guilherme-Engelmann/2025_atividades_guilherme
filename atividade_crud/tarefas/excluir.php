<?php
require_once '../includes/auth.php';
require_login();
require_once '../includes/db.php';
$id = intval($_GET['id'] ?? 0);
$usuario_id = $_SESSION['usuario_id'];
$stmt = $pdo->prepare('DELETE FROM tarefas WHERE id = ? AND usuario_id = ?');
$stmt->execute([$id, $usuario_id]);
header('Location: listar.php');
exit;
?>
