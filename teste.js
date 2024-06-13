

console.log('teste 13412245125124')

//window.alert('bom dia')



let botao = document.getElementById('botao')

botao.addEventListener('click', function() {
    let nome1 = document.getElementById('nome1').value

    document.getElementById('p').innerText = nome1
})