<?php
session_start();
include '../../authGuard/authUsuario.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Configurações</title>
    <script src="../../../scripts/botoesMenus.js"></script>
    <link rel="stylesheet" href="../../../style/style.css">
</head>

<body>
    <header class="headerAzulVoltar">
        <a href="../config/configFuncionario.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main class="mainCentral">
        <div>
            <h1 class="tituloAzul">Mudar a senha</h1>
            <div id="quadradoMenu" style="padding: 10px 7px;">
    
                <form action="" method="post">
                    <label for="senhaAntiga">Senha Antiga:</label><br>
                    <input type="password" class="campoSenhaMudar placeholderClaro" name="senhaAntiga" id="senhaAntiga" placeholder="****">
                    <br>
                    <label for="senhaNova">Senha Nova:</label><br>
                    <input type="password" class="campoSenhaMudar placeholderClaro" name="senhaNova" id="senhaNova" placeholder="****">
                    <input type="submit" class="botaoSimples" value="Confirmar Mudança">
                </form>
            </div>
        </div>
    
    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>

</html>