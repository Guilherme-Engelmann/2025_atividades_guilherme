<?php
require_once 'includes/auth.php';
if(is_logged_in()){
    header('Location: tarefas/listar.php');
    exit;
}else{
    header('Location: login.php');
    exit;
}
?>
