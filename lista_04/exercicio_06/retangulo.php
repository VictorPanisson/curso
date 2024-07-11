<?php

function areaRetangulo($base, $altura) {
    $area = $base * $altura;
    return $area;
}

if (isset($_GET['base'], $_GET['altura'])) {
    $base = floatval($_GET['base']);
    $altura = floatval($_GET['altura']);

    $resultado = areaRetangulo($base, $altura);

    printf("A área do retângulo é %.3f", $resultado);
}