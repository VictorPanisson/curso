function contarPalavras() {
var texto = document.getElementById('texto').value.trim();

var palavras = texto.split(/\b\w+\b/);
palavras = palavras.filter(function(palavra){
return palavra.length;
});
var numeroPalavras = palavras.length;

document.getElementById('resultado').textContent = "Numero De Palavras: " + numeroPalavras;

}