<?php


function converteFahrenheitParaCelsius($fahrenheit) {
    // Fórmula de conversão
    $celsius = 5 * ($fahrenheit - 32) / 9;
    return $celsius;
}


if (isset($_GET['fahrenheit'])) {
    $fahrenheit = (float) $_GET['fahrenheit'];

    $celsius = converteFahrenheitParaCelsius($fahrenheit);

    echo sprintf("%dF é equivalente a %.2fC", $fahrenheit, $celsius);
} else {

    echo "Por favor, forneça a temperatura em Fahrenheit.";
}
