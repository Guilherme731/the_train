<?php
include '../../../conexao/conexao.php';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
}



?>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../../style/style.css">
    <title>Verificação de 2 etapas</title>
</head>

<body>
    <header class="headerAzulLogo">
        <img id="ajusteImagem" src="../../../../assets/logos/logoPequena.png" alt="Logo Pequena">
    </header>
    <a href="../../../../public/recuperarSenha2.php">
        <img src="../../../../assets/icons/header/setaEsquerdaClara.PNG" alt="Seta" onclick="voltarPagina()">
    </a>
    <div class="tituloAzul">
        <h1>Verificação de 2 etapas</h1>
        <br>
    </div>
    <main>
        <br>
        <br>
        <br>
        <div class="container">
            <form method="POST" action="">
                <div class="grupoInputs">
                    <input type="number">
                    <input type="number">
                    <input type="number">
                    <input type="number">
                    <input type="number">
                    <input type="number">
                </div>
                <h2 class="tituloAzul">
                    Um código de verificação foi enviado para o seu email. Insira o código para continuar.
                </h2>
                <button class="ativo" type= "submit" >Reenviar código</button>
            </form>
        </div>
    </main>
    <div class="espacoFooterAzul"></div>
    <footer class="footerAzulArredondado">

    </footer>
</body>

</html>