
const mapa = document.getElementById('svgMapa');

document.addEventListener('DOMContentLoaded', function () {
    // const linhasMapa = document.getElementsByClassName('linhaMapa');
    // for (let i = 0; i < linhasMapa.length; i++) {
    //     linhasMapa[i].addEventListener('click', () => {
    //         linhasMapa[i].classList.toggle('linhaMapaSelecionada');
    //         // console.log(linhasMapa[i].id)
    //     });
    // }
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
function teste(){
    
     console.log(data);
}

function abrirEdicaoRota(rota){
    sessionStorage.setItem('rotaParaEditar', rota);
    window.location.href = 'editarRotas.html';
}

function addQuadradoTrem(x, y, numero) {
  const namespace = "http://www.w3.org/2000/svg";

  // Cria o quadrado
  const trem = document.createElementNS(namespace, "rect");
  trem.setAttribute("x", x);
  trem.setAttribute("y", y);
  trem.setAttribute("width", "15");
  trem.setAttribute("height", "15");
  trem.setAttribute("fill", "#f26419");
  trem.setAttribute("stroke", "black");
  trem.setAttribute("stroke-width", "1");

  // Cria o texto (centralizado)
  const texto = document.createElementNS(namespace, "text");
  texto.setAttribute("x", x + 7.5); // centro X do quadrado
  texto.setAttribute("y", y + 7.5); // centro Y do quadrado
  texto.setAttribute("text-anchor", "middle");
  texto.setAttribute("dominant-baseline", "middle");
  texto.setAttribute("font-size", "12");
  texto.setAttribute("fill", "black");
  texto.textContent = numero;

  // Adiciona ao SVG
  mapa.appendChild(trem);
  mapa.appendChild(texto);
}