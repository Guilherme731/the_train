function validarLogin(){
    //Obter dados de Login
    const emailFuncionario = document.getElementById('emailFuncionarioLogin').value.trim();
    const senhaFuncionario = document.getElementById('senhaFuncionarioLogin').value;

    //Validação dos dados
    // if(!emailFuncionario || !emailFuncionario.includes('@')){
    //     alert('Insira um e-mail válido!');
    //     return;
    // }
    if(!senhaFuncionario){
        alert('Digite uma senha!');
        return;
    }

    //Validação da senha
    //if(senhaFuncionario == 'admin_123'){
        window.location.href = '../../../the_train/private/user/dashboard/dashboard.html';
    //}else{
    //    alert('Senha incorreta! A senha é admin_123');
    //}
}