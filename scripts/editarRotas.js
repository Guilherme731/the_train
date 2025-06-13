const mapaSvg = document.getElementById('svgMapaEditar');
const tituloPagina = document.getElementById('tituloPagina');
const listaEstacoes = document.getElementById("listaEstacoes");
let rota = sessionStorage.getItem('rotaParaEditar');
if (rota) {
    visualizarRota(rota);
    tituloPagina.innerText = 'Editando Rota ' + (parseInt(rota) + 1);

    carregarListaEstacoes(rota);
} else {
    alert('Erro ao obter rota!');
}

function mover(botao, direcao) {
    const item = botao.closest(".estacoes");
    const container = document.getElementById("listaEstacoes");

    if (direcao === "up" && item.previousElementSibling) {
        container.insertBefore(item, item.previousElementSibling);
    } else if (direcao === "down" && item.nextElementSibling) {
        container.insertBefore(item.nextElementSibling, item);
    }

    exibirOrdem();
}

function exibirOrdem() {
    const itens = document.querySelectorAll(".estacoes");
    const ordem = Array.from(itens).map(el => el.dataset.id);
    atualizarMapaPorEstacoes(ordem);
}

function carregarListaEstacoes(numeroRota){
    const rotas = JSON.parse(rotasEstacoes);

    rotas.rotasE[numeroRota].forEach(estacaoNumero => {
        criarElementoEstacao(estacaoNumero);
    });
}

function criarElementoEstacao(estacaoNumero){
    let idEstacao = estacaoNumero;
    if(estacaoNumero == null || estacaoNumero == 0 || estacaoNumero == ''){
        idEstacao = (parseInt(document.querySelectorAll(".estacoes").length) + 1);
    }
    
    if(document.querySelectorAll(".estacoes").length < 6){
        const elementoEstacao = document.createElement('div');
        elementoEstacao.setAttribute("class", "estacoes");
        elementoEstacao.setAttribute("data-id", idEstacao);
    

        const iconeEditar = document.createElement('img');
        iconeEditar.src = "../../../assets/icons/dashboard/editarRota.png";
        iconeEditar.setAttribute("class", "iconeEditarEstacao");
        iconeEditar.setAttribute("onclick", "editarEstacao()");

        const iconeDeletar = document.createElement('img');
        iconeDeletar.src = "../../../assets/icons/dashboard/deletar.png";
        iconeDeletar.setAttribute("class", "iconeEditarEstacao");
        iconeDeletar.onclick = () => {
            elementoEstacao.remove();
            exibirOrdem();
        };

        const moverCima = document.createElement('img');
        moverCima.src = "../../../assets/icons/dashboard/irParaCima.png";
        moverCima.setAttribute("class", "moverEstacoesCima");
        moverCima.setAttribute("onclick", "mover(this, 'up')");

        const moverBaixo = document.createElement('img');
        moverBaixo.src = "../../../assets/icons/dashboard/irParaBaixo.png";
        moverBaixo.setAttribute("class", "moverEstacoesBaixo");
        moverBaixo.setAttribute("onclick", "mover(this, 'down')");


        const divFlex = document.createElement('div');
        divFlex.setAttribute("class", "flex");


        const div = document.createElement('div');

        const h3 = document.createElement('h3');
        h3.setAttribute("class", "textoAzul");
        h3.innerText = 'Estação ' + idEstacao;


        const divFlex2 = document.createElement('div');
        divFlex2.setAttribute("class", "flex");


        
        divFlex.appendChild(iconeEditar);
        divFlex.appendChild(iconeDeletar);
        divFlex.appendChild(moverCima);
        divFlex.appendChild(moverBaixo);

        div.appendChild(divFlex);

        divFlex2.appendChild(h3);
        divFlex2.appendChild(div);

        elementoEstacao.appendChild(divFlex2);

        listaEstacoes.appendChild(elementoEstacao);
    }

    exibirOrdem();
}

function editarEstacao(){
    alert('Não é possível editar sem banco de dados!');
}

function renderizarNumerosEstacoes(){
    renderizarNumeros(95, 140, 1);
    renderizarNumeros(260, 140, 2);
    renderizarNumeros(340, 75, 3);
    renderizarNumeros(260, 10, 4);
    renderizarNumeros(145, 10, 5);
    renderizarNumeros(200, 75, 6);
}

function renderizarNumeros(x, y, numero){
    const namespace = "http://www.w3.org/2000/svg";
    const texto = document.createElementNS(namespace, "text");
    texto.setAttribute("x", x); 
    texto.setAttribute("y", y); 
    texto.setAttribute("text-anchor", "middle");
    texto.setAttribute("dominant-baseline", "middle");
    texto.setAttribute("font-size", "14");
    texto.setAttribute("fill", "#f6ae2d");
    texto.textContent = numero;

    mapaSvg.appendChild(texto);
}

renderizarNumerosEstacoes();