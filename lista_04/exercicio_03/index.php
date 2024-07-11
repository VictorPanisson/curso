<?php
function ehPar($num) {
    if ($num % 2 == 0) {
        return "<p>O numero $num é par.</p>";
    } else {
        return "<p>O numero $num é impar.</p>";
    }
}

if (isset($_GET['numero'])) {
    $numero = $_GET['numero'];

    echo ehPar($numero);
}