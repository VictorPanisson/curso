function calcular() {
    // Obter os valores dos inputs
    var num1 = parseFloat(document.getElementById('num1').value);
    var num2 = parseFloat(document.getElementById('num2').value);
    var operacao = document.getElementById('operacao').value;
    var resultado = 0;

    // Realizar a operação selecionada
    switch (operacao) {
        case 'somar':
            resultado = num1 + num2;
            break;
        case 'subtrair':
            resultado = num1 - num2;
            break;
        case 'multiplicar':
            resultado = num1 * num2;
            break;
        case 'dividir':
            resultado = num1 / num2;
            break;
        default:
            resultado = "Operação inválida";
            break;
    }

    // Exibir o resultado na div resultado
    document.getElementById('resultado').textContent = "Resultado: " + resultado;
}