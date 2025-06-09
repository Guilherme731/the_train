function cadastrar(){
    const nome = document.getElementsByTagName('Nome').value.trim();
    const email = document.getElementsByTagName('email').value.trim();
    const senha = document.getElementsByTagName('Senha').value.trim();
    const CPF = document.getElementsByTagName('CPF').value.trim();


    if(!nome || ){
        alert("Preencher Nome Corretamente.");
        return;
    }else{
        console.log(nome);
    }

    if(!email){
        alert("Preencher Email Corretamente.");
        return;
    }else{
        console.log(email);
    }

    if(!senha){
        alert("Preencher senha Corretamente.");
        return;
    }else{
        console.log(senha);
    }
    
    if(!CPF){
        alert("Preencher CPF Corretamente.");
        return;
    }else{
        console.log(CPF);
    }
}