<?php


function buscaMaiorValor($valor1, $valor2, $valor3) {

    $maior = $valor1;


    if ($valor2 > $maior) {
        $maior = $valor2;
    }

 
    if ($valor3 > $maior) {
        $maior = $valor3;
    }

    return $maior;
}


if (isset($_GET['valor1'], $_GET['valor2'], $_GET['valor3'])) {

    $valor1 = intval($_GET['valor1']);
    $valor2 = intval($_GET['valor2']);
    $valor3 = intval($_GET['valor3']);


    $maiorValor = buscaMaiorValor($valor1, $valor2, $valor3);

    echo $maiorValor;
}
