document.getElementById('calcular').addEventListener('click', function() {
    let raio = parseFloat(document.getElementById('raio').value);

    if (isNaN(raio) || raio <= 0) {
        document.getElementById('resultado').innerText = "Por favor, insira um valor de raio válido.";
        return;
    }

    fetch('area_circulo.php?raio=' + encodeURIComponent(raio))
        .then(response => response.text())
        .then(texto => {
            document.getElementById('resultado').innerText = texto;
        })
        .catch(erro => {
            console.error(erro);
            document.getElementById('resultado').innerText = "Ocorreu um erro ao calcular a área.";
        });
});
