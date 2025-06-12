
const tituloPagina = document.getElementById('tituloPagina');
let rota = sessionStorage.getItem('rotaParaEditar');
if (rota) {
    visualizarRota(rota);
    tituloPagina.innerText = 'Editando Rota ' + (parseInt(rota) + 1);
    } else {
    alert('Erro ao obter rota!');
}

