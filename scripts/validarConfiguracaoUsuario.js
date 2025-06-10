document.addEventListener("DOMContentLoaded", function(){
    const formulario = document.getElementById("formularioConfgUsuario");

    formulario.addEventListener("submit", function(e){
        e.preventDefault();

        document.getElementById("errorSenhaFuncionario").textContent = "";
        document.getElementById("errorDia").textContent = "";
        document.getElementById("errorMes").textContent = "";
        document.getElementById("errorAno").textContent = "";
        document.getElementById("errorGenero").textContent = "";

        const senha = document .getElementById("senha").value.trim();
        const dia = document .getElementById("dataNascimentoDia").value.trim();
        const mes = document .getElementById("dataNascimentoMes").value.trim();
        const ano = document .getElementById("dataNascimentoAno").value.trim();
        const genero = document .getElementsByClassName("genero").value;

        console.log(senha);
        console.log(dia);
        console.log(mes);
        console.log(ano);
        console.log(genero);

        if(!senha){
            document.getElementById("errorSenhaFuncionario").textContent = "Coloque a Senha de Forma Certa.";
            valido = false;
        }

        if(!dia){
            document.getElementById("errorDia").textContent = "Coloque o Dia de Nascimento de Forma Certa.";
            valido = false;
        }

        if(!mes){
            document.getElementById("errorMes").textContent = "Coloque o Mês de Nascimento de Forma Certa.";
            valido = false;
        }


        if(!ano){
            document.getElementById("errorAno").textContent = "Coloque o Ano de Nascimento de Forma Certa.";
            valido = false;
        }

        if(!genero){
            document.getElementsByClassName("errorGenero").textContent = "Coloque o Gênero.";
            valido = false;
        }

        if(valido){
            alert("Alteração Feita Com Sucesso.");
            formulario.reset();
        }
    })
})
