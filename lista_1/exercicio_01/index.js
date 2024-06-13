function exibirSaudacao() {
    var nome = document.getElementById("nome").value;
    document.getElementById("mensagem").innerText = "Olá " + nome + ", este é meu site.";
}