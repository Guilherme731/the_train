const adicionarButton = document.getElementById("adicionar");
const cancelarButton = document.getElementById("cancelar");

check.addEventListener("submit", function (e){
    e.preventDefault();
    check.reset();
    alert("Audiência marcada!");
})

function cancelar(){
    alert("Sua audiência foi cancelada");
}



