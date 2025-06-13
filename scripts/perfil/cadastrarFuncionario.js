document.addEventListener("DOMContentLoaded", function(){
    const formulario = document.getElementById("validarCadastroFuncionario");

    formulario.addEventListener("submit", function(e){
        e.preventDefault();

        document.getElementById("errorNome").textContent = "";
        document.getElementById("errorEmail").textContent = "";
        document.getElementById("errorSenha").textContent = "";
        document.getElementById("errorCpf").textContent = "";

        const nome = document .getElementById("nomeFuncionario").value.trim();
        const email = document .getElementById("emailFuncionario").value.trim();
        const senha = document .getElementById("senhaFuncionario").value.trim();
        const cpf = document .getElementById("cpfFuncionario").value.trim();

        if(!nome){
            document.getElementById("errorNome").textContent = "Coloque o Nome de Forma Certa.";
            valido = false;
        }

        if(!senha || senha.length < 8){
            document.getElementById("errorSenha").textContent = "A Senha Deve Ter Pelo Menos 8 Caracteres";
            valido = false;
        }

        if(!cpf || cpf.length > 11 || cpf.length < 11){
            document.getElementById("errorCpf").textContent = "O CPF Deve Ter 11 Caracteres";
            valido = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(!emailRegex.test(email)){
            document.getElementById("errorEmail").textContent = "E-mail Inválido.";
            valido = false;
        }

        if(valido){
            alert("Funcionario Cadastrado Com Sucesso!");
            formulario.reset();
        }
    })
})