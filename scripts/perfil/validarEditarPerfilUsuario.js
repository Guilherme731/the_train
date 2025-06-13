document.addEventListener("DOMContentLoaded", function(){
    const formulario = document.getElementById("formularioEditarPerfilUsuario");
    
    formulario.addEventListener("submit", function(e){
    e.preventDefault();

    let valido = true;

    document.getElementById("erroCargo").textContent = "";
    document.getElementById("erroCPF").textContent = "";
    document.getElementById("erroEmail").textContent = "";
    document.getElementById("erroNomeUsuario").textContent = "";

    const cargo = document.getElementById("cargo").value.trim();
    const cpf = document.getElementById("cpf").value.trim();
    const email = document.getElementById("email").value.trim();
    const nomeUsuario = document.getElementById("nomeUsuario").value.trim();

    if (!cargo){
        document.getElementById("erroCargo").textContent = "Preencha o cargo para salvar as informações.";
        valido = false;
    }

    if (!cpf || cpf.length > 11 || cpf.length < 11){
        document.getElementById("erroCPF").textContent = "O CPF deve ser preenchido e ter 11 caracteres.";
        valido = false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!emailRegex.test(email)) {
        document.getElementById("erroEmail").textContent = "E-mail Inválido ou não preenchido.";
        valido = false;
    }

   if (!nomeUsuario){
    document.getElementById("erroNomeUsuario").textContent = "O nome precisa ser preenchido.";
    valido = false;
   }
   
    });
});
