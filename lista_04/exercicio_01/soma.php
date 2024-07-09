<?php

class Soma {
    function somaDoisValores($valor1, $valor2) {
        return $valor1 + $valor2;
    }
}

$somaClass = new Soma();

echo $somaClass->somaDoisValores($_GET['valor1'], $_GET['valor2']);