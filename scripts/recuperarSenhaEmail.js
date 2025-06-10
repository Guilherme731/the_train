    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    function validarEmail(){
        const email = document.getElementById('inputTextPadrao').value;
        const emailValido = regexEmail.test(email);
        if(emailValido){
            //window.location.href = '../../../the_train/public/recuperarSenha2.html';
            window.location.href = 'recuperarSenha2.html';
        } else{
            alert('O email está incorreto, digite-o novamente da maneira correta para continuar.');
        }
    }