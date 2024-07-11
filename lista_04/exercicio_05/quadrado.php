<?php


function areaQuadrado($base, $altura) {

    $area = $base * $altura;

    // Retornando a área calculada
    return $area;
}


if (isset($_GET['base'], $_GET['altura'])) {

    $base = floatval($_GET['base']);
    $altura = floatval($_GET['altura']);

    $resultado = areaQuadrado($base, $altura);

    printf("A area do quadrado eh %.3f", $resultado);
}
