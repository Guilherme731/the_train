function validarConfigUser(){
    const senha = document.getElementById("senha").value;
    console.log(senha)
    const Dia = document.getElementById("dataNascimentoDia").value;
    console.log(Dia)
    const Mes = document.getElementsByClassName("dataNascimentoMesAno").value;
    console.log(Mes)
    const Ano = document.getElementsByClassName("dataNascimentoMesAno").value;
    console.log(Ano)
    const genero = document.getElementsByName("genero").value;
    console.log(genero)



    if(!senha){
        alert("Coloque Senha Para Continuar");
        return;
    }

    if(!Dia){
        alert("Coloque o Dia De Seu Nascimento Corretamente Para Continuar");
        return;        
    }

    if(!Mes){
        alert("Coloque o Mês De Seu Nascimento Corretamente Para Continuar");
        return;        
    }

    if(!Ano){
        alert("Coloque o Ano De Seu Nascimento Corretamente Para Continuar");
        return;        
    }

    if(!genero){
        alert("Coloque o Seu Gênero Para Continuar");
        return;        
    }
} 

       
   