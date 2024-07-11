<?php
function swap(&$a, &$b) {
    printf("Valores antes da troca: A = %d, B = %d\n", $a, $b);

    $temp = $a;
    $a = $b;
    $b = $temp;

    printf("Valores apos a troca: A = %d, B = %d\n", $a, $b);

    return "Valores antes da troca: A = $a, B = $b\nValores após a troca: A = $b, B = $a";
}

if (isset($_GET['valor1']) && isset($_GET['valor2'])) {
  $valor1 = $_GET['valor1'];
  $valor2 = $_GET['valor2'];
  
  $resultado = swap($valor1, $valor2);

  echo $resultado;
} else {
    echo 'parametros não encontrados.';
}

