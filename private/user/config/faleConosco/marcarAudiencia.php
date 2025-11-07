<?php
session_start();
include '../../../authGuard/authUsuario.php';
include '../../../conexao/conexao.php'
?>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../../../scripts/botoesMenus.js"></script>
    <script src="../../../../scripts/iconeEnviar.js"></script>
    <link rel="shortcut icon" href="../../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../../style/style.css">
    <title>Reportar erro</title>
</head>
<body>
    <header class="headerAzulVoltar">
        <img src="../../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
    </header>
    <main>
        <div id="quadradoMenu">
            <div class="flexCentro textoCentral">
                <img class="iconeConfigTamanho" src="../../../../assets/icons/config/faleConoscoIcone.png" alt="imagem do icone fale conosco">
                <h2>Marque uma audiência</h2>
            </div>

            <br>
            <div class="opcaoMenu padding-20">
                <form action="" method="POST">
                <textarea name="marcarAudiencia" id="caixaMensagem" required></textarea>
                <button id="botao" type="submit"><img class="iconeConfigTamanho" src="../../../../assets/icons/config/EnviarIcone.PNG" alt="Imagem do icone enviar"></button>
                </form>
               
            </div>
        </div>

    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>
</html>