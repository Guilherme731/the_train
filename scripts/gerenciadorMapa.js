

function atualizaOpcoesMapa() {
    const inputEstacoes = document.getElementById('ver-estacoes');
    const inputTrens = document.getElementById('ver-trens');
    console.log(inputEstacoes);
    if (inputEstacoes.checked == true) {
        mostraEstacoes();
    }
    else {
        escondeEstacoes();
    }
}

function mostraEstacoes() {
    let estacoes = document.getElementsByClassName('quadradoMapa');
    for(let i = 0; i < estacoes.length; i++){
        estacoes[i].style.display = 'block';
    }
}
function escondeEstacoes() {
    let estacoes = document.getElementsByClassName('quadradoMapa');
    for(let i = 0; i < estacoes.length; i++){
        estacoes[i].style.display = 'none';
    }
}