document.addEventListener("DOMContentLoaded", function(){
    const formulario = document.getElementById("formularioRecuperarSenha");
    
    formulario.addEventListener("submit", function(e){
    e.preventDefault();

    let valido = true;

    document.getElementById("erroNovaSenha").textContent = "";
    document.getElementById("erroConfirmacaoSenha").textContent = "";

    const novaSenha = document.getElementById("novaSenha").value.trim();
    const confirmacaoSenha = document.getElementById("confirmacaoSenha").value.trim();

    if (novaSenha.length < 8 || !novaSenha){
        document.getElementById("erroNovaSenha").textContent = "A senha deve ter pelo menos 8 caracteres.";
        valido = false;
    }

    if (confirmacaoSenha.length < 8 || !confirmacaoSenha){
        document.getElementById("erroConfirmacaoSenha").textContent = "A senha deve ter pelo menos 8 caracteres.";
        valido = false;
    }

    if(novaSenha !== confirmacaoSenha){
        alert("A nova senha e a confirmação devem ser iguais para alterar a senha.");
        valido = false;
    }

    if(valido){
        window.location.href = '../../../the_train/public/login.html';
    }
    });
});
