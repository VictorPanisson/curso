function editarUsuario(indice) {
    var tabela = document.getElementById('tabelaUsuarios');
    var linha = tabela.rows[indice + 1];

    var nome = linha.cells[0].textContent;
    var email = linha.cells[1].textContent;

    document.getElementById('nome').value = nome;
    document.getElementById('email').value = email;
document.getElementById('indiceUsuario').value = indice.toString();
}

function limparFormulario() {
    document.getElementById('nome').value = '';
    document.getElementById('email').value = '';
    document.getElementById('indiceUsuario').value = '';
}

document.getElementById('cadastroForm').addEventListener('submit', function(event) {
event.preventDefault();

var nome = document.getElementById('nome').value;
var email = document.getElementById('email').value;
var indice = document. getElementById('indiceUsuario').value;

var tabela = document.getElementById('tabelaUsuarios');
var linha = tabela.rows[parseInt(indice) + 1];

linha.cells[0].textContent = nome;
linha.cells[1].textContent = email;

limparFormulario();
});