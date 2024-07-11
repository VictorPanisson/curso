const formulario = document.getElementById('formulario');

formulario.addEventListener('submit', function(event) {
    event.preventDefault(); // Evitando o envio padrão do formulário

    const base = document.getElementById('base').value;
    const altura = document.getElementById('altura').value;

    fetch(`retangulo.php?base=${base}&altura=${altura}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('resultado').innerHTML = data;
        })
        .catch(error => {
            console.error('Erro ao calcular área:', error);
        });
});
