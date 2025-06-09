let  areaAlertas = null;

document.addEventListener('DOMContentLoaded', function () {
    areaAlertas = document.getElementById('areaAlertas');

    
    // TODO: Apagar as chamadas de funções abaixo quando implementá-las automaticamente
    addAlerta('Começou a chover na estação 2', 'chuva');
    addAlerta('Trem 5 atrasou 3 minutos para chegar na estação 3', 'atraso');
    addAlerta('Trem 4 apresenta problemas no sistema de ar condicionado', 'falha');
    addAlerta('Começou a chover na estação 1', 'chuva');

    verificarAlertasVazio();
});

const titulosAlertas = {
      "chuva": "CHUVA",
      "atraso": "ATRASO",
      "falha": "FALHA MECÂNICA"
    };

const iconesAlertas = {
      "chuva": "../../assets/icons/alertas/chuvaIcone.png",
      "atraso": "../../assets/icons/alertas/relogioIcone.png",
      "falha": "../../assets/icons/alertas/trianguloexclamacaoIcone.png"
    };

function addAlerta(mensagem, tipo){
    const alerta = document.createElement('div');
    alerta.className = `alerta ${tipo}`;

    // PARTE DE ÍCONE
    const icone = document.createElement('img');
    icone.src = iconesAlertas[tipo];

    // PARTE DE TEXTOS
    const divTexto = document.createElement('div');
    divTexto.className = 'textoEsquerda';

    const titulo = document.createElement('p');
    titulo.className = 'mensagemPrincipal margin-0';
    titulo.innerText = titulosAlertas[tipo];

    const texto = document.createElement('p');
    texto.className = 'mensagemSecundaria margin-0';
    texto.innerText = mensagem;

    divTexto.appendChild(titulo);
    divTexto.appendChild(texto);


    // PARTE DE HORA
    const divFinal = document.createElement('div');
    divFinal.className = 'finalAlerta';

    const fechar = document.createElement('button');
    fechar.onclick = () => {
        alerta.remove()
        verificarAlertasVazio();
    };

    const data = new Date();
    const hora = document.createElement('p');
    hora.className = 'horaAlerta';
    hora.innerText = data.getHours() + ':' + data.getMinutes();

    const iconeFechar = document.createElement('img');
    iconeFechar.src = '../../assets/icons/alertas/fecharIcone.png';

    fechar.appendChild(iconeFechar);
    divFinal.appendChild(fechar);
    divFinal.appendChild(hora);


    // CONSTRUÇÃO DO ALERTA
    alerta.appendChild(icone);
    alerta.appendChild(divTexto);
    alerta.appendChild(divFinal);

    areaAlertas.appendChild(alerta);

    verificarAlertasVazio();
}

function fecharTodosAlertas(){
    areaAlertas.innerHTML = '<div id="semAlertas">Não há mensagens.</div>';

    verificarAlertasVazio();
}

function verificarAlertasVazio(){
    const msgVazia = document.getElementById('semAlertas');
    const temNotificacoes = areaAlertas.querySelectorAll('.alerta').length > 0;
      msgVazia.style.display = temNotificacoes ? 'none' : 'block';
}
 