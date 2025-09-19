document.addEventListener("DOMContentLoaded", function(){
    const formulario = document.getElementById("validarCadastroFuncionario");

    formulario.addEventListener("submit", function(e){
        e.preventDefault();

        document.getElementById("errorNome").textContent = "";
        document.getElementById("errorEmail").textContent = "";
        document.getElementById("errorSenha").textContent = "";
        document.getElementById("errorCpf").textContent = "";
        document.getElementById("errorCargo").textContent = "";
        document.getElementById("errorSalario").textContent = "";
        document.getElementById("errorGenero").textContent = "";
        document.getElementById("errorDataNascimento").textContent = "";

        const nome = document .getElementById("nomeFuncionario").value.trim();
        const email = document .getElementById("emailFuncionario").value.trim();
        const senha = document .getElementById("senhaFuncionario").value.trim();
        const cpf = document .getElementById("cpfFuncionario").value.trim();
        const cargo = document .getElementById("cargoFuncionario").value.trim();
        const salario = document .getElementById("salarioFuncionario").value.trim();
        const genero = document .getElementById("generoFuncionario").value.trim();
        const dataNascimento = document .getElementById("dataNascimentoFuncionario").value.trim();

        if(!nome){
            document.getElementById("errorNome").textContent = "Coloque o Nome de Forma Certa.";
            valido = false;
        }

        if(!senha || senha.length < 8){
            document.getElementById("errorSenha").textContent = "A Senha Deve Ter Pelo Menos 8 Caracteres.";
            valido = false;
        }

        if(!cpf || cpf.length > 11 || cpf.length < 11){
            document.getElementById("errorCpf").textContent = "O CPF Deve Ter 11 Caracteres.";
            valido = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(!emailRegex.test(email)){
            document.getElementById("errorEmail").textContent = "E-mail Inválido.";
            valido = false;
        }

        if(!cargo){
            document.getElementById("errorCargo").textContent = "Coloque o Cargo de Forma Certa.";
            valido = false;
        }

        if(!salario){
            document.getElementById("errorSalario").textContent = "Coloque o Salario de Forma Certa.";
            valido = false;
        }

        if(!genero){
            document.getElementById("errorGenero").textContent = "Coloque o Gênero de Forma Certa.";
            valido = false;
        }

        if(!dataNascimento){
            document.getElementById("errorDataNascimento").textContent = "Coloque a Data de Nascimento de Forma Certa.";
            valido = false;
        }

        if(valido){
            alert("Funcionario Cadastrado Com Sucesso!");
            formulario.reset();
        }
    })
})