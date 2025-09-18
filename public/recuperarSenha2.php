<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../style/style.css">
    <title>Recuperar senha</title>
</head>

<body>
    
    <?php include '../private/includes/header/headerLogo.php'; ?>

    <a href="../public/recuperarSenha.php">
        <img src="../assets/icons/header/setaEsquerdaClara.PNG" alt="Seta" onclick="voltarPagina()">
    </a>
    <div class="tituloAzulEscuro">
        <h1>Recuperar senha</h1>
        <br>
    </div>
    <main class="gridCentro">
        <form id="formularioRecuperarSenha" class="gridCentro">
            <input type="password" name="novaSenha" id="novaSenha" class="inputTextPadrao" placeholder="Nova senha">
            <div class="error" id="erroNovaSenha"></div>
            <input type="password" name="confimacaoSenha" id="confirmacaoSenha" class="inputTextPadrao"
                placeholder="Confirmar senha">
            <div class="error" id="erroConfirmacaoSenha"></div>
            <div class="aDireita">
                <button id="botaoAlterarSenha" id="botaoSubmit" type="submit">
                    <p>Alterar Senha</p>
                </button>
            </div>
        </form>
    </main>

    <div class="espacoFooterAzul"></div>
    <footer class="footerAzulArredondado">

    </footer>

    <script src="../scripts/login/novaSenha.js"></script>
</body>

</html>