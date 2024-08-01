document.getElementById('verificar').addEventListener('click', function() {
    let ano = parseInt(document.getElementById('ano').value);

    if (isNaN(ano)) {
        document.getElementById('resultado').innerText = "Por favor, insira um ano válido.";
        return;
    }


    fetch('verifica_bissexto.php?ano=' + encodeURIComponent(ano))
        .then(response => response.text())
        .then(texto => {
            document.getElementById('resultado').innerText = texto;
        })
        .catch(erro => {
            console.error(erro);
            document.getElementById('resultado').innerText = "Ocorreu um erro ao verificar o ano.";
        });
});