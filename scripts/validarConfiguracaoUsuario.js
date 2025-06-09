function validarConfigUser(){
    const senha = document.getElementById('senha').value;
    console.log(senha)
    const Dia = document.getElementById('dataNascimentoDia').value;
    console.log(Dia)
    const Mes = document.getElementsByClassName('dataNascimentoMes').value;
    console.log(Mes)
    const Ano = document.getElementsById('dataNascimentoAno').value;
    console.log(Ano)
    const genero = document.getElementsByName('genero').value;
    console.log(genero)



    if(!senha){
        alert("Coloque Senha Para Continuar");
        return;
    }else{
        console.log(senha);
    }

    if(!Dia){
        alert("Coloque o Dia De Seu Nascimento Corretamente Para Continuar");
        return;        
    }else{
        console.log(Dia);
    }

    if(!Mes){
        alert("Coloque o Mês De Seu Nascimento Corretamente Para Continuar");
        return;        
    }else{
        console.log(Mes);
    }

    if(!Ano){
        alert("Coloque o Ano De Seu Nascimento Corretamente Para Continuar");
        return;        
    }else{
        console.log(Ano);
    }

    if(!genero){
        alert("Coloque o Seu Gênero Para Continuar");
        return;        
    }else{
        console.log(genero);
    }
} 

       
   