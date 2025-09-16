document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.getElementById("entradaEmail");

    formulario.addEventListener("submit", function (e) {
        e.preventDefault();

        document.getElementById("errorEmailLogin").textContent = "";

        const email = document.getElementById("digitarEmail").value.trim();

        let valido = true;

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            document.getElementById("errorEmailLogin").textContent = "E-mail Inválido.";
            valido = false;
        }

        if (valido == true) {
            window.location.href = 'codigoVerificacao.php';
        }

    })
})