function verificarIdade() {
    var idade = document.getElementById('Idade').value;

    idade = parseInt(idade);
    if (idade >= 18) {
document.getElementById('mensagemIdade').textContent = 'Você é Maior De idade'
    } else {
document.getElementById('mensagemIdade').textContent = 'Você é Menor De idade'
    }
}