document.getElementById('converter').addEventListener('click', function() {
    let fahrenheit = parseFloat(document.getElementById('fahrenheit').value);

    if (isNaN(fahrenheit)) {
        document.getElementById('resultado').innerText = "Por favor, insira um valor de temperatura válido.";
        return;
    }


    fetch('conversao.php?fahrenheit=' + encodeURIComponent(fahrenheit))
        .then(response => response.text())
        .then(texto => {
            document.getElementById('resultado').innerText = texto;
        })
        .catch(erro => {
            console.error(erro);
            document.getElementById('resultado').innerText = "Ocorreu um erro ao converter a temperatura.";
        });
});