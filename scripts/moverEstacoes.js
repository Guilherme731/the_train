let estacoes = ["Estação 1", "Estação 2", "Estação 3", "Estação 4"];

function renderizarEstacoes() {
  const container = document.getElementById("lista-estacoes");
  container.innerHTML = "";

  estacoes.forEach((nome, index) => {
    const div = document.createElement("div");
    div.className = "estacao";

    div.innerHTML = `
          <span class="nome-estacao">${nome}</span>
          <div class="botoes">
            <span class="botao" onclick="moverCima(${index})">🔼</span>
            <span class="botao" onclick="moverBaixo(${index})">🔽</span>
          </div>
        `;
    container.appendChild(div);
  });
}

function irParaCima(index) {
  if (index > 0) {
    [estacoes[index], estacoes[index - 1]] = [estacoes[index - 1], estacoes[index]];
    renderizarEstacoes();
  }
}

function irParaBaixo(index) {
  if (index < estacoes.length - 1) {
    [estacoes[index], estacoes[index + 1]] = [estacoes[index + 1], estacoes[index]];
    renderizarEstacoes();
  }
}

renderizarEstacoes();