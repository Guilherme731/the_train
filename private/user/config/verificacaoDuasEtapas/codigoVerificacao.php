<?php
session_start();
include '../../../authGuard/authUsuario.php';


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../../assets/logos/logoPequena.png">
    <script src="../../../../scripts/botoesMenus.js"></script>
    <script src="../../../../scripts/configFuncionarioSalvarInformacoes.js"></script>

    <link rel="stylesheet" href="../../../../style/style.css">

    <title>Verificação de duas etapas</title>
</head>
<body>
    <header class="headerAzulVoltar">
        <a href="../../config/configFuncionario.php">
            <img src="../../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
        </a>
    </header>

    <main>
    <div class="flexCentral textoCentral marginTop-100">
        <img id="iconeVerificacao2Etapas" src="../../../../assets/icons/config/verificacaoDuasEtapas/verificacao2EtapasIconeLaranja.png" alt="Icone de verificação de 2 etapas Laranja">
    </div>

    <div class="flexCentro">
        <form action="">
        <input class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required> 

        <input class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required>
    
        <input class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required>
    
        <input class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required>
    
        <input class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required>
    
        <input class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required>

        <br>
        <br>

        <button type="submit" class="botaoEnviar">Ativar verificação</button>
        </form>
    </div>
       

    <p id="textoVerificacao2EtapasConfirmacao">Um código de verificação foi enviado para o seu email. Insira o código para continuar.</p>
    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>
</html>