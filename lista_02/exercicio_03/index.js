function enviarFormulario() {
    let nome = document.getElementById('nome').value.trim();
    let email = document.getElementById('email').value.trim();

    if (nome === '') {
        alert('Por favor, preencha todos os campos.');
        return;
    }
    if(email === '') {
        alert('Por favor, preencha todos os campos.');
        return;  
    }

    let tabela = document.getElementById('corpoTabela');
    let novaLinha = tabela.insertRow();
    let celulaNome = novaLinha.insertCell(0);
    let celulaEmail = novaLinha.insertCell(1);

    celulaNome.textContent = nome;
    celulaEmail.textContent = email;

    document.getElementById('nome').value = '';
    document.getElementById('email').value = '';
}