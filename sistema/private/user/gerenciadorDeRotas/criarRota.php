<?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $stmt = $conn->prepare("INSERT INTO rotas(nome) VALUES (?)");
    $stmt->bind_param("s", $_POST['nomeRota']);
    $stmt->execute();
    header('location: gerenciarRotas.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Nova Rota</title>
    <script src="../../../scripts/botoesMenus.js"></script>
    <link rel="stylesheet" href="../../../style/style.css">
</head>

<body>
    <header class="headerAzulVoltar">
        <a href="gerenciarRotas.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main class="mainCentral">
        <div>
            <h1 class="tituloAzul">Criar nova Rota</h1>
            <div id="quadradoMenu" style="padding: 10px 7px;">
    
                <form action="" method="post">
                    <label for="nomeRota">Nome da Rota:</label><br>
                    <input type="text" class="campoSenhaMudar placeholderClaro" name="nomeRota" id="nomeRota" placeholder="Rota" required>
                    <br>
                    <br>
                    <input type="submit" class="botaoSimples" value="Confirmar Nova Rota">
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