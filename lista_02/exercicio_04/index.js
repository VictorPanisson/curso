document.getElementById('cadastroForm').addEventListener('submit', function(event) {
event.preventDefault();

var nome = document.getElementById('nome').value;
var email = document.getElementById('email').value;

document.getElementById('nome').value = '';
document.getElementById('email').value = '';

var tabela = document.getElementById('tabelaUsuarios').getElementsByTagName('tbody')[0];
var novaLinha = tabela.insertRow();

var colunaNome = novaLinha.insertCell(0);
var colunaEmail = novaLinha.insertCell(1);

colunaNome.textContent = nome;
colunaEmail.textContent = email;

})