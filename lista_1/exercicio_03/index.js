function calcularIdade() {
var anoNascimento = document.getElementById('anoNascimento').value;

var anoAtual = new Date().getFullYear();

var Idade = anoAtual - anoNascimento;

document.getElementById('resultadoIdade').textContent = 'Sua Idade é: ' + Idade + ' anos';
}