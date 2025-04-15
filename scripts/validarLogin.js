function validarLogin(){
    //Obter dados de Login
    const emailFuncionario = document.getElementById('email_funcionario').value.trim();
    const senhaFuncionario = document.getElementById('senha_funcionario').value;

    //Validação dos dados
    if(!emailFuncionario || !emailFuncionario.includes('@')){
        alert('Insira um e-mail válido!');
        return;
    }
    if(!senhaFuncionario){
        alert('Digite uma senha!');
        return;
    }

    //Validação da senha
    if(senhaFuncionario == 'admin_123'){
        window.location.href = '../the_train/config/configFuncionario.html';
    }else{
        alert('Senha incorreta! A senha é admin_123');
    }
}