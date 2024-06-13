var botao = document.getElementById("botao");
var contador = document.getElementById("contador");

var cliques = 0;

botao.addEventListener("click", function() {

    cliques++;

    contador.textContent = cliques + (cliques === 1 ? " cliques" : " cliques");
});