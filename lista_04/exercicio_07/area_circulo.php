<?php

function areaCirculo($raio) {
    $pi = 3.14159;
    $area = $pi * pow($raio, 2); 
    return $area;
}


if (isset($_GET['raio'])) {
    $raio = (float) $_GET['raio']; 
    if ($raio > 0) {
        $area = areaCirculo($raio);
        echo sprintf("A área do círculo é %.3f", $area); 
    } else {
        echo "O valor do raio deve ser maior que zero.";
    }
} else {
    echo "Por favor, forneça o raio do círculo.";
}