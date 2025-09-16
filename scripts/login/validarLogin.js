document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.getElementById("formLogin");

    formulario.addEventListener("submit", function (e) {
        e.preventDefault();

        document.getElementById("errorEmailLogin").textContent = "";
        document.getElementById("errorSenhaLogin").textContent = "";

        const email = document.getElementById("emailFuncionarioLogin").value.trim();
        const senha = document.getElementById("senhaFuncionarioLogin").value.trim();

        let valido = true;

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            document.getElementById("errorEmailLogin").textContent = "E-mail Inválido.";
            valido = false;
        }

        if (!senha || senha.length < 8) {
            document.getElementById("errorSenhaLogin").textContent = "A Senha Deve Ter Pelo Menos 8 Caracteres";
            valido = false;
        }

        if (valido == true) {
<<<<<<< HEAD
            window.location.href = '../dashboard/dashboard.php';
=======
            //window.location.href = '../private/user/dashboard/dashboard.html';
>>>>>>> c9f27b78aad55e36a9cd4e5380f67efa8de21891
        }

    })
})