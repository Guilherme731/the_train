let rotasSegmentos = '{ "rotas" : [' +

'["RCI",'+
'"CDI" ],'+

'["CCI", ' +
'"CCS", ' +
'"CDI", ' +
'"CDS" ],' +

'["CEI", ' +
'"CES", ' +
'"RES", ' +
'"RCS" ]' +
']}';

document.addEventListener('DOMContentLoaded', function () {
    const linhasMapa = document.getElementsByClassName('linhaMapa');
    for (let i = 0; i < linhasMapa.length; i++) {
        linhasMapa[i].addEventListener('click', () => {
            linhasMapa[i].classList.toggle('linhaMapaSelecionada');
            // console.log(linhasMapa[i].id)
        });
    }
});

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
    for (let i = 0; i < estacoes.length; i++) {
        estacoes[i].style.display = 'block';
    }
}
function escondeEstacoes() {
    let estacoes = document.getElementsByClassName('quadradoMapa');
    for (let i = 0; i < estacoes.length; i++) {
        estacoes[i].style.display = 'none';
    }
}

function visualizarRota(numeroRota){
    limpaSelecaoMapa();
    const rota = JSON.parse(rotasSegmentos);


    rota.rotas[numeroRota].forEach(nomeSegmento => {
        const segmento = document.getElementById('linha' + nomeSegmento)
        segmento.classList.add('linhaMapaSelecionada');
    });
}

function limpaSelecaoMapa(){
    const linhasMapa = document.getElementsByClassName('linhaMapa');
    for (let i = 0; i < linhasMapa.length; i++) {
        linhasMapa[i].classList.remove('linhaMapaSelecionada');
    }
}