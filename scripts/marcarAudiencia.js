const adicionarButton = document.getElementById("adicionar");
const cancelarButton = document.getElementById("cancelar");
const form = document.getElementById("check");

function mostrarErro(mensagem) {
    let erro = document.getElementById("erro-form");
    if (!erro) {
        erro = document.createElement("div");
        erro.id = "erro-form";
        erro.style.color = "red";
        erro.style.marginTop = "10px";
        form.appendChild(erro);
    }
    erro.textContent = mensagem;
}

function limparErro() {
    const erro = document.getElementById("erro-form");
    if (erro) erro.textContent = "";
}

adicionarButton.addEventListener("click", function (e) {
    e.preventDefault();
    const horario = form.elements["horário"].value;
    const audienciaInputs = form.querySelectorAll('input[name="audiência/horário"]');
    const audienciaNum = audienciaInputs[0]?.value || "";
    const audienciaHora = audienciaInputs[1]?.value || "";
    if (!horario || !audienciaNum || !audienciaHora) {
        mostrarErro("Preencha todos os campos corretamente!");
        return;
    }
    alert("Audiência marcada!");
    form.reset();
    limparErro();
});

cancelarButton.addEventListener("click", function (e) {
    e.preventDefault();
    const horario = form.elements["horário"].value;
    const audienciaInputs = form.querySelectorAll('input[name="audiência/horário"]');
    const audienciaNum = audienciaInputs[0]?.value || "";
    const audienciaHora = audienciaInputs[1]?.value || "";
    if (!horario || !audienciaNum || !audienciaHora) {
        mostrarErro("Preencha todos os campos corretamente!");
        return;
    }
    alert("Audiência cancelada!");
    form.reset();
    limparErro();
});