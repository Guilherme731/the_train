//renderizarTrensMapa();
escondeTrens();

function aplicarRotas(){
    alert('As mudanças não podem ser aplicadas pois não há banco de dados ainda!')
}

function criarRota(){
    alert('Não é possível registrar uma nova rota porque não há banco de dados!')
}

function atualizarSelects(){
    const selects = document.getElementsByClassName('selecionarRota');
    const trem = JSON.parse(trensPosicoes);

    let i = 0;
    trem.trens.forEach(tremRota => {
        selects[i].selectedIndex = tremRota[2];
        i++;
    });
}

function desligarTrem(numeroTrem){
    alert('O desligamento do trem ' + (numeroTrem + 1) + ' foi agendado para o próximo sensor/estação.');
}

atualizarSelects();