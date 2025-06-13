
const mapa = document.getElementById('svgMapa');

document.addEventListener('DOMContentLoaded', function () {
    const linhasMapa = document.getElementsByClassName('linhaMapa');
    for (let i = 0; i < linhasMapa.length; i++) {
        linhasMapa[i].addEventListener('click', () => {
            linhasMapa[i].classList.toggle('linhaMapaSelecionada');
            console.log(linhasMapa[i].id)
        });
     }
});

function atualizaOpcoesMapa() {
    const inputEstacoes = document.getElementById('ver-estacoes');
    const inputTrens = document.getElementById('ver-trens');
    if (inputEstacoes.checked == true) {
        mostraEstacoes();
    }
    else {
        escondeEstacoes();
    }
    if (inputTrens.checked == true) {
        mostraTrens();
    }
    else {
        escondeTrens();
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
function mostraTrens(){
    const trens = document.getElementsByClassName('tremMapa');
    const textos = document.getElementsByClassName('textoMapa');
    for (let i = 0; i < trens.length; i++) {
        trens[i].setAttribute("visibility", "visible");
        textos[i].setAttribute("visibility", "visible");
    }
}
function escondeTrens(){
    const trens = document.getElementsByClassName('tremMapa');
    const textos = document.getElementsByClassName('textoMapa');
    for (let i = 0; i < trens.length; i++) {
        trens[i].setAttribute("visibility", "hidden");
        textos[i].setAttribute("visibility", "hidden");
    }
}

function mostraTremEspecifico(numeroTrem){
    escondeTrens();
    const trem = document.getElementById('tremMapa' + numeroTrem);
    const texto = document.getElementById('textoMapa' + numeroTrem);
    trem.setAttribute("visibility", "visible");
        texto.setAttribute("visibility", "visible");
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

function abrirEdicaoRota(rota){
    sessionStorage.setItem('rotaParaEditar', rota);
    window.location.href = 'editarRotas.html';
}

function addQuadradoTrem(x, y, numero) {
  const namespace = "http://www.w3.org/2000/svg";

  const trem = document.createElementNS(namespace, "rect");
  trem.setAttribute("x", x);
  trem.setAttribute("y", y);
  trem.setAttribute("width", "15");
  trem.setAttribute("height", "15");
  trem.setAttribute("fill", "#f26419");
  trem.setAttribute("stroke", "black");
  trem.setAttribute("stroke-width", "1");
  trem.classList.add('tremMapa');
  trem.setAttribute("id", "tremMapa" + (numero - 1));


  const texto = document.createElementNS(namespace, "text");
  texto.setAttribute("x", x + 7.5); 
  texto.setAttribute("y", y + 7.5); 
  texto.setAttribute("text-anchor", "middle");
  texto.setAttribute("dominant-baseline", "middle");
  texto.setAttribute("font-size", "12");
  texto.setAttribute("fill", "black");
  texto.textContent = numero;
  texto.setAttribute("class", "textoMapa");
  texto.setAttribute("id", "textoMapa" + (numero - 1));

  mapa.appendChild(trem);
  mapa.appendChild(texto);
}

function renderizarTrensMapa(){
    const trem = JSON.parse(trensPosicoes);

    let i = 1;
    trem.trens.forEach(tremCoordenada => {
        addQuadradoTrem(tremCoordenada[0], tremCoordenada[1], i);
        i++;
    });
}

