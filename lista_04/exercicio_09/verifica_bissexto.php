<?php


function ehBissexto($ano) {
   
    if (($ano % 400 == 0) || (($ano % 4 == 0) && ($ano % 100 != 0))) {
        return 1; 
    } else {
        return 0; 
    }
}


if (isset($_GET['ano'])) {
 
    $ano = (int) $_GET['ano'];


    $resultado = ehBissexto($ano);

 
    if ($resultado == 1) {
        echo sprintf("O ano %d eh bissexto", $ano);
    } else {
        echo sprintf("O ano %d nao eh bissexto", $ano);
    }
} else {
  
    echo "Por favor, forneça um ano para verificar.";
}
