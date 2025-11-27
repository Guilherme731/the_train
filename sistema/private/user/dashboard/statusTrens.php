<?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';

$sqlTrens = 'SELECT trens.nome AS nomeTrem, rotas.nome AS nomeRota, ativo, quantidadePassageiros, velocidade, idRota FROM trens INNER JOIN rotas ON rotas.id = idRota';
$resultTrens = $conn->query($sqlTrens);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Status dos Trens</title>
    <link rel="stylesheet" href="../../../style/style.css">
</head>

<body>
    <header class="headerPrincipal">
        <a href="../../../private/<?php if ($_SESSION['tipo'] == 'admin') {
                                        echo 'admin/config/configAdmin.php';
                                    } else {
                                        echo 'user/config/configFuncionario.php';
                                    } ?>"><img src="../../../assets/icons/header/engrenagemIcone.png" alt="Configurações"></a>
        <img src="../../../assets/logos/logoPequena.png" alt="Logo">
        <a href="../alertas.php"><img src="../../../assets/icons/header/sinoIcone.png" alt="Notificações"></a>
    </header>

    <main>
        <section class="secaoInfo">
            <div id="tituloDados">
                <a href="dashboard.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt=""></a>
                <div class="textoCentral">
                    <h2>STATUS - TRENS</h2>
                </div>
            </div>
            <?php
            while ($row = $resultTrens->fetch_assoc()) {
                echo "<div class='dadoStatusTrens'>
                <div class='tremStatus1'>";
                if($row['ativo']){
                    echo "<img src='../../../assets/icons/dashboard/circuloVerdeIcone.png' alt='simboloStatusVerde'>";
                }else{
                    echo "<img src='../../../assets/icons/dashboard/circuloLaranjaIcone.png' alt='simboloStatusVermelho'>";
                }
                echo "
                <p>{$row['nomeTrem']}</p>
                </div>
                <div class='tremStatus2'>
                    <img src='../../../assets/icons/dashboard/velocidadeIcone.png' alt='simboloVelocidade'>
                    <p>{$row['velocidade']}</p>
                    <p class='textSize-10'>Km/h</p>
                </div>
                <div class='tremStatus3'>
                    <img src='../../../assets/icons/dashboard/pessoaIcone.png' alt='simboloPessoa'>
                    <p>{$row['quantidadePassageiros']}</p>
                </div>
                <div class='tremStatus4'>
                    <p>{$row['nomeRota']}</p>
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
            <a href="../dashboard/dashboard.php"><img src="../../../assets/icons/footer/dashboardIcone.png" alt="Dashboard"></a>
            <a href="../gerenciadorDeRotas/gerenciarRotas.php"><img src="../../../assets/icons/footer/rotasIcone.png" alt="Rotas"></a>
            <a href="../manutencao/manutencao.php"><img src="../../../assets/icons/footer/manutencaoIcone.png" alt="Manutenção"></a>
            <a href="../relatorios/relatorios.php"><img src="../../../assets/icons/footer/relatoriosIcone.png" alt="Relatórios"></a>
        </div>
    </footer>
</body>

</html>