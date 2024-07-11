function buscarMaiorValor() {
    let valor1 = parseInt(document.getElementById('valor1').value);
    let valor2 = parseInt(document.getElementById('valor2').value);
    let valor3 = parseInt(document.getElementById('valor3').value);

    fetch(`omaior.php?valor1=${valor1}&valor2=${valor2}&valor3=${valor3}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('resultado').textContent = data;
        })
        .catch(error => {
            console.error('Ocorreu um erro:', error);
        });
}