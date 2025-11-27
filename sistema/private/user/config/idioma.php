<?php
session_start();
include '../../authGuard/authUsuario.php';
?>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../../scripts/botoesMenus.js"></script>
    <link rel="stylesheet" href="../../../style/style.css">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Idioma</title>
</head>

<body>
    <header class="headerAzulVoltar">
        <img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
    </header>
    <main>
        <div id="quadradoIdioma">
            <div class="flexCentro textoCentral">
                <img class="iconeConfigTamanho" src="../../../assets/icons/config/idiomaIcone.png" alt="imagem do icone idioma">
            <h2>Idioma</h2>
            </div>
                <div class="gridCentro">
                    <select class="flexCentro" id="selecao">
                        <option value="Português(Brasil)">Português(Brasil)</option>
                        <option value="Português(Brasil)">Alemão</option>
                        <option value="Português(Brasil)">Árabe</option>
                        <option value="Português(Brasil)">Armênio</option>
                        <option value="Português(Brasil)">Catalão</option>
                        <option value="Português(Brasil)">Coreano</option>
                        <option value="Português(Brasil)">Chinês</option>
                        <option value="Português(Brasil)">Dinamarquês</option>
                        <option value="Português(Brasil)">Espanhol</option>
                    <select>
                </div>
            </div>
        </div>  
    </main>
    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>

</html>