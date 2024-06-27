let formulario = document.getElementById("formulario")

formulario.addEventListener("submit", function(evento) {
    evento.preventDefault();

    let nome =  document.getElementById("nome").value
    let email =  document.getElementById("email").value
if (nome == '') {
    alert('Por Favar Preencha o Nome.');
    return;
}

if(email == '') {
    alert('Por Favor Preencha o Email.')
}

   let meuJson = {
        nome: nome,
        email: email
   }

   console.log(meuJson)
})