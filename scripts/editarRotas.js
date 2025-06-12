

let rota = sessionStorage.getItem('rotaParaEditar');
if (rota) {
    visualizarRota(rota);
    } else {
    alert('Erro ao obter rota!');
}

