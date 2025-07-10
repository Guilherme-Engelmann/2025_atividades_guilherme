<?php

 $mensagem = 'Olá Mundo!';
    echo $mensagem;

    echo '<h2>Olá, mundo!</h2>';

    $primeiro_nome = 'Guilherme';
    $idade = 17;
    $gosta_de_bolo = true;

    $resultado_ano = 2025 - $idade;

    echo $resultado_ano;

    echo'<br>';
    echo'<br>';

    $num = 37.5;

    echo $num;

    $num2 = (int) $num;

    echo'<br>';
    echo'<br>';

    echo $num2;
    $nota= 2;

    if($nota >= 7){
        echo '<p>Passou na prova<p>';
    }else if ($nota == 2){
        echo '<p>Você é uma vergonha<p>';
    }else{
        echo '<p>Não passou na prova</p>';
    };

    for($i = 0; $i <=5; $i++){

        echo "<p> Contagem: $i</p>";
    };

    $frutas = array('laranja','banana','tomate','beramoa');

    echo $frutas[0];

    function saudacao($nome){
        return "olá $nome";
    };
    echo'<br>';
    echo'<br>';
    echo saudacao('Paulo');


?>
