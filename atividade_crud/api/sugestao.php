<?php
// api/sugestao.php - Consome BoredAPI
header('Content-Type: application/json');
$resp = file_get_contents('https://www.boredapi.com/api/activity');
echo $resp;
?>
