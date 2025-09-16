    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    function validarEmail(){
        const email = document.getElementById('email').value;
        const emailValido = regexEmail.test(email);
        document.getElementById("erroEmail").textContent= "";

        let valido = true;

        if(emailValido){
            //window.location.href = '../../../the_train/public/recuperarSenha2.html';
            window.location.href = 'recuperarSenha2.php';
        } else{
            document.getElementById("erroEmail").innerHTML = "O email está incorreto ou o campo está vazio, <br> digite-o novamente da maneira correta para continuar."
            valido = false;
        }
    }