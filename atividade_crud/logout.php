<?php
// logout.php - encerra sessão
session_start();
session_destroy();
header('Location: login.php');
exit;
?>
