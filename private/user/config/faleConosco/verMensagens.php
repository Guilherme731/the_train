<?php
session_start();
include '../../../authGuard/authUsuario.php';
include '../../../conexao/conexao.php';

$id = $_SESSION['user_id'];


?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Mensagens</title>
    <link rel="shortcut icon" href="../../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../../style/style.css">
</head>
<body>
    <header class="headerAzulVoltar">
        <a href="../../../admin/config/configAdmin.php"><img src="../../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>
    

    <footer class="footerAzulLogo">
        <img src="../../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>
</html>