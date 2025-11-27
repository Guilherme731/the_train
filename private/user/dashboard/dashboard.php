<?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';
$id = $_SESSION['user_id'];

$sqlUsers = "SELECT nome FROM usuarios WHERE id=$id LIMIT 3";
$resultUsers = $conn->query($sqlUsers);
$user = $resultUsers->fetch_assoc();

$sqlTrens = 'SELECT trens.nome AS nomeTrem, rotas.nome AS nomeRota, ativo, quantidadePassageiros, velocidade, idRota, horaSaida, parado, idEstacao FROM trens INNER JOIN rotas ON rotas.id = idRota LIMIT 3';
$resultTrens = $conn->query($sqlTrens);
$resultTrens2 = $conn->query($sqlTrens);

$sqlEstacoes = 'SELECT id, nomeEstacao, temperatura, estaChovendo, umidade FROM estacoes LIMIT 3';
$resultEstacoes = $conn->query($sqlEstacoes);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../../style/style.css">
</head>
<body>
    <header class="headerPrincipal">
    <a href="../../../private/<?php if($_SESSION['tipo'] == 'admin'){echo 'admin/config/configAdmin.php';} else {echo 'user/config/configFuncionario.php';}?>"><img src="../../../assets/icons/header/engrenagemIcone.png" alt="Configurações"></a>
    <img src="../../../assets/logos/logoPequena.png" alt="Logo">
    <a href="../alertas.php"><img src="../../../assets/icons/header/sinoIcone.png" alt="Notificações"></a>
</header>
    <a href="usuarios.php"><div class='quadradoUsuarios'>
        <img id="iconeUsuarios" src="../../../assets/icons/dashboard/botaoVisualizarUsuarios.png" alt="Botão para visualizar usuários">
    </div>
    </a>
     <h4 class="flexCentro" style="background-color: #33658a; width:fit-content; text-align:center; margin:20px auto; padding: 5px; border: solid 3px #f6ae2d; border-radius: 15px; color:#f6ae2d; max-width: 60%;">Você tem sessão iniciada como <?=$user['nome']?>.</h4>
     <section class="secaoInfo">
        <h2>HORÁRIOS</h2>

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
    
        </div>
        <div class="textoDireita">
            <a href="horarios.php" class="botaoAmarelo">Ver Tudo</a>
        </div>
    
    </section>

    <section class="secaoInfo">
        <h2>STATUS - TRENS</h2>
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
        <div class="textoDireita">
            <a href="statusTrens.php" class="botaoAmarelo">Ver Tudo</a>
        </div>
    </section>

    <section  class="secaoInfo">
        <h2>STATUS - ESTAÇÕES</h2>
        <?php
            while ($row = $resultEstacoes->fetch_assoc()) {
                $id = $row['id'];
                $queryTrem = "SELECT idEstacao FROM trens WHERE idEstacao = $id";
                $existeTrem = ($conn->query($queryTrem))->fetch_assoc();
                
                echo "
                <div class='dadoStatusEstacoes'>
                <div>
                    <img src='../../../assets/icons/dashboard/circuloVerdeIcone.png' alt='simboloStatusVerde'>
                    <p>{$row['nomeEstacao']}</p>
                </div>
                <div>";
                if($row['estaChovendo']){
                    echo "<div class='iconeETempStatusEstacoes'><img src='../../../assets/icons/dashboard/chuvaIcone.png' alt='Ícone de chuva'></div>";
                }else{
                    echo "<div class='iconeETempStatusEstacoes'><img src='../../../assets/icons/dashboard/solIcone.png' alt='Ícone de sol'></div>";
                }
                if($existeTrem){
                    echo "<div class='iconeETempStatusEstacoes'><img src='../../../assets/icons/dashboard/comTremIcone.png' alt='Ícone de trem'></div>";
                }else{
                    echo "<div class='iconeETempStatusEstacoes'><img src='../../../assets/icons/dashboard/semTremIcone.png' alt='Ícone de sem trem'></div>";
                }
                    
                    
                    echo "
                    <p class='iconeETempStatusEstacoes'>{$row['temperatura']}ºC | {$row['umidade']}%</p>
                </div>
            </div>
                ";
            }
            ?>
        <div class="textoDireita">
            <a href="statusEstacoes.php" class="botaoAmarelo">Ver Tudo</a>
        </div>
    </section>

    <div class="espacoFooterPrincipal"></div>

    <footer class="footerPrincipal">
        <div class="barraLinhaSelecao">
            <div class="linhaAmarela linhaPos1"></div>
        </div>
        <div class="navbar">
            <a href="dashboard.php"><img src="../../../assets/icons/footer/dashboardIcone.png" alt="Dashboard"></a>
            <a href="../gerenciadorDeRotas/gerenciarRotas.php"><img src="../../../assets/icons/footer/rotasIcone.png" alt="Rotas"></a>
            <a href="../manutencao/manutencao.php"><img src="../../../assets/icons/footer/manutencaoIcone.png" alt="Manutenção"></a>
            <a href="../relatorios/relatorios.php"><img src="../../../assets/icons/footer/relatoriosIcone.png" alt="Relatórios"></a>
        </div>
    </footer>
</body>
</html>