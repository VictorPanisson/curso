document.addEventListener('DOMContentLoaded', function() {
    let form = document.getElementById('formNumero');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        let numero = document.getElementById('numero').value;

        fetch(`imparepar.php?numero=${numero}`)
        .then(function(resposta){
            return resposta.text();
        })
.then(function(resultado){
    let mensagem = document.getElementById('mensagem');
    mensagem.innerHTML = resultado;
})
.catch(function(error){
    console.error('Erro ao verificar numero:',error);
        });
    });
});