<?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';

$idRota = $_GET['idRota'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $resultOrdem = $conn->query("SELECT MAX(ordem) AS maxima_ordem FROM rotasestacoes WHERE idRota=$idRota");
    $proximaOrdem = ($resultOrdem->fetch_assoc())['maxima_ordem'] + 1;
    $stmt = $conn->prepare("INSERT INTO rotasestacoes(idRota, idEstacao, ordem) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $idRota, $_POST['idEstacao'], $proximaOrdem);
    $stmt->execute();
    header("location: editarRotas.php?id=$idRota");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Adicionar Estação na Rota</title>
    <script src="../../../scripts/botoesMenus.js"></script>
    <link rel="stylesheet" href="../../../style/style.css">
</head>

<body>
    <header class="headerAzulVoltar">
        <a href="gerenciarRotas.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main class="mainCentral">
        <div>
            <h1 class="tituloAzul">Adicionar Estação na Rota</h1>
            <div id="quadradoMenu" style="padding: 10px 7px;">
    
                <form action="" method="post">
                    <label for="nomeRota">Selecione uma Estação:</label><br>
                    <select class="selecionarRota" id="cargoFuncionario" name="idEstacao">
                        <?php 
                        $resultEstacoes = $conn->query("SELECT * FROM estacoes");
                        while($row = $resultEstacoes->fetch_assoc()){
                            echo "<option value='{$row['id']}'> {$row['id']} - {$row['nomeEstacao']}</option>"; 
                        }

                        ?>
                    </select>
                    <br>
                    <br>
                    <input type="submit" class="botaoSimples" value="Adicionar">
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