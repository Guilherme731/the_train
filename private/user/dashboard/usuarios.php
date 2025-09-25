<?php
include '../../conexao/conexao.php';

$sql = 'SELECT id, nome, cargo FROM usuarios';
$result = $conn->query($sql);

?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../style/style.css">
    <script src="../../../scripts/botoesMenus.js"></script>
    <title>Selecionar Usuário</title>
</head>

<body>
    <header class="headerAzulVoltar">
        <img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
    </header>

    <main class="gridCentro">
        <div id="usuarioTitulo">
            <h1>Usuários</h1>
        </div>

        
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "
                
                <div class='quadradoAzulEscuro'>
            <div class='quadradoAzulNormal'>
                <h3>{$row['nome']}</h3>
            </div>

            <div class='quadradoAzulNormal'>
                <h3>{$row['cargo']}</h3>
            </div>
            <br>
        </div>
                ";
        }
        ?>

    </main>

    <div class="espacoFooterAzulLogo"></div>
    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>

</html>