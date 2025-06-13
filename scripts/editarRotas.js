
const tituloPagina = document.getElementById('tituloPagina');
let rota = sessionStorage.getItem('rotaParaEditar');
if (rota) {
    visualizarRota(rota);
    tituloPagina.innerText = 'Editando Rota ' + (parseInt(rota) + 1);
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
      console.log("Ordem atual:", ordem);
    }

