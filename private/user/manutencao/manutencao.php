<?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';

$sqlMantuncao = "SELECT manutencoes.id, manutencoes.tipoManutencao, estacoes.nomeEstacao, trens.nome, manutencoes.descricao FROM manutencoes INNER JOIN estacoes ON manutencoes.idEstacao = estacoes.id INNER JOIN trens ON manutencoes.idTrem = trens.id";
$reultManutencao = $conn->query($sqlMantuncao);

// Separar as manutenções por tipo
$preventivas = [];
$inspecoes = [];
if ($reultManutencao && $reultManutencao->num_rows > 0) {
    while ($row = $reultManutencao->fetch_assoc()) {
        if ($row['tipoManutencao'] == 'Manutenções Preventivas') {
            $preventivas[] = $row;
        } elseif ($row['tipoManutencao'] == 'Controle de inspeções') {
            $inspecoes[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../style/style.css">

    <title>Manutenção</title>
</head>
<body>
    
<header class="headerPrincipal">
    <a href="../../../private/<?php if($_SESSION['tipo'] == 'admin'){echo 'admin/config/configAdmin.php';} else {echo 'user/config/configFuncionario.php';}?>"><img src="../../../assets/icons/header/engrenagemIcone.png" alt="Configurações"></a>
    <img src="../../../assets/logos/logoPequena.png" alt="Logo">
    <a href="../alertas.php"><img src="../../../assets/icons/header/sinoIcone.png" alt="Notificações"></a>
</header>

    <main>
        
    <form method="POST" action="deletarManutencao.php">
    <section class="secaoInfoManutencao">
        <h2>Manutenções Preventivas</h2>
        <?php
        if (count($preventivas) > 0) {
            foreach ($preventivas as $row) {
                $manutencaoTipo = $row['tipoManutencao'];
                $descricao = $row['descricao'];
                $estacaoManutencao = $row['nomeEstacao'];
                $tremManutencao = $row['nome'];
                $id = $row['id'];
                echo "<div class='dadoInfo'>
                <div class='dadoInfoLeft'>
                    <p class='textoPrincipalDado'>$tremManutencao</p>
                    <p class='textoSecundarioDado'>$descricao</p>
                </div>
                <div class='dadoInfoCenter'>
                    <img src='../../../assets/icons/dashboard/circuloLaranjaIcone.png' alt='iconeUrgência'>
                </div>
                <div class='dadoInfoRight'>
                    <p class='textoPrincipalDado'>$estacaoManutencao</p>
                    <a href='deletarManutencao.php?ida=$id'><img class='manutencaoFinalAlerta' src='../../../assets/icons/alertas/fecharIcone.png' alt='iconeDeletarManutencao'></a>
                </div>
        
            </div>";
            }
        } 
        ?>
    </section>

    <section class="secaoInfoManutencao">
        <h2>Controle de inspeções</h2>
        <?php
        if (count($inspecoes) > 0) {
            foreach ($inspecoes as $row) {
                $manutencaoTipo = $row['tipoManutencao'];
                $descricao = $row['descricao'];
                $estacaoManutencao = $row['nomeEstacao'];
                $tremManutencao = $row['nome'];
                $id = $row['id'];
                echo "<div class='dadoInfo'>
                <div class='dadoInfoLeft'>
                    <p class='textoPrincipalDado'>$tremManutencao</p>
                    <p class='textoSecundarioDado'>$descricao</p>
                </div>
                <div class='dadoInfoCenter'>
                    <img src='../../../assets/icons/dashboard/esclamaçãoIcone.png' alt='iconeUrgência'>
                </div>
                <div class='dadoInfoRight'>
                    <p class='textoPrincipalDado'>$estacaoManutencao</p>
                    <a href='deletarManutencao.php?ida=$id'><img class='manutencaoFinalAlerta' src='../../../assets/icons/alertas/fecharIcone.png' alt='iconeDeletarManutencao'></a>

                </div>
        
            </div>";
            }
        } else {
            echo "<div id='semAlertas'>Não há inspeções no momento.</div>";
        }
        ?>
    </section>
    
    
</form>
    </main>

    <div class="espacoFooterPrincipal"></div>
    <footer class="footerPrincipal">
        <div class="barraLinhaSelecao">
            <div class="linhaAmarela linhaPos3"></div>
        </div>
        <div class="navbar">
            <a href="../dashboard/dashboard.php"><img src="../../../assets/icons/footer/dashboardIcone.png" alt="Dashboard"></a>
            <a href="../gerenciadorDeRotas/gerenciarRotas.php"><img src="../../../assets/icons/footer/rotasIcone.png" alt="Rotas"></a>
            <a href=""><img src="../../../assets/icons/footer/manutencaoIcone.png" alt="Manutenção"></a>
            <a href="../relatorios/relatorios.php"><img src="../../../assets/icons/footer/relatoriosIcone.png" alt="Relatórios"></a>
        </div>
    </footer>
    
</body>
</html>