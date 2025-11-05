<?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';

$sqlTrens = 'SELECT trens.nome AS nomeTrem, rotas.nome AS nomeRota, ativo, quantidadePassageiros, velocidade, idRota, horaSaida, parado, idEstacao FROM trens INNER JOIN rotas ON rotas.id = idRota';
$resultTrens2 = $conn->query($sqlTrens);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Horários</title>
    <link rel="stylesheet" href="../../../style/style.css">
</head>
<body>
    <header class="headerPrincipal">
    <a href="../../../private/<?php if($_SESSION['tipo'] == 'admin'){echo 'admin/config/configAdmin.php';} else {echo 'user/config/configFuncionario.php';}?>"><img src="../../../assets/icons/header/engrenagemIcone.png" alt="Configurações"></a>
    <img src="../../../assets/logos/logoPequena.png" alt="Logo">
    <a href="../alertas.php"><img src="../../../assets/icons/header/sinoIcone.png" alt="Notificações"></a>
</header>

    <main>
        <section class="secaoInfo">
            <div id="tituloDados">
                <a href="dashboard.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt=""></a>
            <div class="textoCentral"><h2>HORÁRIOS</h2></div>
            </div>
            <?php
            while ($row = $resultTrens2->fetch_assoc()) {
                $idEstacao = $row['idEstacao'];
                $queryEstacao = "SELECT nomeEstacao FROM estacoes WHERE id = $idEstacao";
                $est = ($conn->query($queryEstacao))->fetch_assoc();

                $horaSaida = substr($row['horaSaida'], 0, -3);

                $timestamp = strtotime(date($row['horaSaida']));
                $novo_timestamp = strtotime('+5 minutes', $timestamp);
                $chegadaEstimada = date('H:i', $novo_timestamp);

                echo "<div class='dadoInfo dashboard'>
                <div class='dadoInfoLeft'>
                    <p class='textoPrincipalDado'>{$row['nomeTrem']}</p>";
                    if($row['parado']){
                        echo "<p class='textoSecundarioDado'>Embarcando...</p>";
                    }else{
                        echo "<p class='textoSecundarioDado'>Saiu as {$horaSaida}</p>";
                    }
                    echo "
                    
                </div>
                <div class='dadoInfoCenter'>";
                    if($row['parado']){
                        echo "<img src='../../../assets/icons/dashboard/paradoIcone.png' alt='iconeParado'>";
                    }else{
                        echo "<img src='../../../assets/icons/dashboard/trafegandoIcone.png' alt='iconeTrafegando'>";
                    }
                    echo "
                
                </div>
                <div class='dadoInfoRight'>
                    <p class='textoPrincipalDado'>{$est['nomeEstacao']}</p>";
                    if($row['parado']){
                        echo "<p class='textoSecundarioDado'>Sai as {$horaSaida}</p>";
                    }else{
                        echo "<p class='textoSecundarioDado'>Chega as $chegadaEstimada</p>";
                    }
                    echo "
                </div>
            </div>";
            }
            ?>
    </section>
    </main>

    <footer class="footerPrincipal"> 
        <div class="barraLinhaSelecao">
            <div class="linhaAmarela linhaPos1"></div>
        </div>
        <div class="navbar">
            <a href="../../../private/user/dashboard/dashboard.php"><img src="../../../assets/icons/footer/dashboardIcone.png" alt="Dashboard"></a>
            <a href="../gerenciadorDeRotas/gerenciarRotas.php"><img src="../../../assets/icons/footer/rotasIcone.png" alt="Rotas"></a>
            <a href="../manutencao/manutencao.php"><img src="../../../assets/icons/footer/manutencaoIcone.png" alt="Manutenção"></a>
            <a href="../relatorios/relatorios.php"><img src="../../../assets/icons/footer/relatoriosIcone.png" alt="Relatórios"></a>
        </div>
    </footer>
</body>
</html>