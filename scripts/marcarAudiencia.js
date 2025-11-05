const adicionarButton = document.getElementById("adicionar");
const cancelarButton = document.getElementById("cancelar");

check.addEventListener("submit", function (e){
    e.preventDefault();
    check.reset();
    alert("Audiência marcada!");
})

check.addEventListener("button", function (e){
    e.preventDefault();
    check.reset();
    alert("Sua audiência foi cancelada");
})


