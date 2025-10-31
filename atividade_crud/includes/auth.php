<?php
// includes/auth.php - controle de sessão e login
session_start();
function is_logged_in() {
    return isset($_SESSION['usuario_id']);
}
function require_login() {
    if (!is_logged_in()) {
        header('Location: /2025_atividades_guilherme/atividade_crud/login.php');
        exit;
    }
}
?>
