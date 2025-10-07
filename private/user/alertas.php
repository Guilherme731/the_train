    <?php
session_start();
include '../authGuard/authUsuario.php';
include '../conexao/conexao.php';

$id = $_SESSION['user_id'];

$sqlAlertas = "SELECT notificacoes.descricao AS descricaoAlerta, notificacoes.horario AS horarioAlerta, notificacoes.tipo AS tipoAlerta, notificacoes.id AS idAlerta FROM alertas INNER JOIN notificacoes ON idNotificacao = notificacoes.id WHERE idFuncionario = $id";
$resultAlertas = $conn->query($sqlAlertas);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/logos/logoPequena.png">
    <title>Alertas - The Train</title>
    <link rel="stylesheet" href="../../style/style.css">
    <script src="../../scripts/botoesMenus.js"></script>
    
</head>
<body>

<header class="headerPrincipal">
    <a href="../../private/<?php if($_SESSION['tipo'] == 'admin'){echo 'admin/config/configAdmin.php';} else {echo 'user/config/configFuncionario.php';}?>"><img src="../../assets/icons/header/engrenagemIcone.png" alt="Configurações"></a>
    <img src="../../assets/logos/logoPequena.png" alt="Logo">
    <a href="alertas.php"><img src="../../assets/icons/header/sinoIcone.png" alt="Notificações"></a>
</header>

    <main>
        <section class="secaoInfo">
            <div id="tituloDados">
                <a href="dashboard/dashboard.php"><img src="../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
            <div class="textoCentral"><h2>ALERTAS</h2></div>
            </div>
            <div id="areaAlertas">
            <?php
            if($resultAlertas->num_rows > 0){
              while ($row = $resultAlertas->fetch_assoc()){
                $nomeTipo = $row['tipoAlerta'];
                $tipo = 'atraso';
                if($nomeTipo == 'Falha Mecanica'){
                    $tipo = 'falha';
                }elseif($nomeTipo == 'Chuva'){
                    $tipo = 'chuva';
                }
                $descricao = $row['descricaoAlerta'];
                $horario = substr($row['horarioAlerta'], 0, 5);
                $idAlerta = $row['idAlerta'];

                echo "<div class='alerta $tipo'>
                <img src='../../assets/icons/alertas/chuvaIcone.png'>
                <div class='textoEsquerda'>
                    <p class='mensagemPrincipal margin-0'>" . strtoupper($nomeTipo) . "</p>
                    <p class='mensagemSecundaria margin-0'>$descricao</p>
                </div>
                <div class='finalAlerta'>
                    <a href='fecharAlerta.php?idAlerta=$idAlerta'><img src='../../assets/icons/alertas/fecharIcone.png'></a>
                    <p class='horaAlerta'>$horario</p>
                </div>
                ";
                echo "</div>";
                
            }  
            }else{
                echo "<div id='semAlertas'>Não há mensagens.</div>";
            }
            
            ?>
                
            </div>
            <a href="fecharTodosAlertas.php" class="botaoAmarelo">Fechar Tudo</a>
        </section>
    </main>


    <div class="espacoFooterPrincipal"></div>

    <footer class="footerPrincipal">
        <div class="barraLinhaSelecao">
            <div class="linhaAmarela"></div>
        </div>
        <div class="navbar">
            <a href="dashboard/dashboard.php"><img src="../../assets/icons/footer/dashboardIcone.png" alt="Dashboard"></a>
            <a href="gerenciadorDeRotas/gerenciarRotas.php"><img src="../../assets/icons/footer/rotasIcone.png" alt="Rotas"></a>
            <a href="manutencao/manutencao.php"><img src="../../assets/icons/footer/manutencaoIcone.png" alt="Manutenção"></a>
            <a href="relatorios/relatorios.php"><img src="../../assets/icons/footer/relatoriosIcone.png" alt="Relatórios"></a>
        </div>
    </footer>
</body>
</html>