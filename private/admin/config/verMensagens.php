<?php
session_start();
include '../../authGuard/authAdmin.php';
include '../../conexao/conexao.php';

$id = $_SESSION['user_id'];

$sqlMensagens = "SELECT mensagens.id, mensagens.id_remetente, mensagens.tipo, mensagens.id_destinatario, mensagens.conteudo, mensagens.data_envio FROM mensagens INNER JOIN usuarios";
$reultMensagens = $conn->query($sqlMensagens);






?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Mensagens</title>
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../style/style.css">
    <script src="../../../scripts/botoesMenus.js"></script>
</head>
<body>
    <header class="headerAzulVoltar">
        <a href="../../../private/<?php if($_SESSION['tipo'] == 'admin'){echo 'admin/config/configAdmin.php';} else {echo 'user/config/configFuncionario.php';}?>"><img src="../../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
        <img src="../../assets/logos/logoPequena.png" alt="Logo">
        <a href="alertas.php"><img src="../../assets/icons/header/sinoIcone.png" alt="Notificações"></a>
    </header>
    
    <section class="secaoInfo">
            <div id="tituloDados">
                <a href="dashboard/dashboard.php"><img src="../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
            <div class="textoCentral"><h2>ALERTAS</h2></div>
            </div>
            <div id="areaAlertas">
            <?php
            if($resultAlertas->num_rows > 0){
              while ($row = $resultAlertas->fetch_assoc()){
                $nomeTipo = $row['tipo'];
                    $tipo = 'duvida';
                if($nomeTipo == 'reportarErro'){
                    $tipo = 'erro';
                }elseif($nomeTipo == 'marcarAudiencia'){
                    $tipo = 'audiencia';
                }
                $conteudo = $row['conteudo'];
                $data = substr($row['data_envio'], 0, 5);
                $idMensagem = $row['id'];
                $destinatario = $row['id_destinatario'];

                echo "<div class='alerta'>
                <div class='textoEsquerda'>
                    <p class='mensagemPrincipal margin-0'>" . strtoupper($nomeTipo) . "</p>
                    <p class='mensagemSecundaria margin-0'>$conteudo</p>
                </div>
                <div class='finalAlerta'>
                    <a href='fecharAlerta.php?ida=$idMensagem'><img src='../../assets/icons/alertas/fecharIcone.png'></a>
                    <p class='data_envio'>$data</p>
                    <p class='data_envio'>$data</p>
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






    <footer class="footerAzulLogo">
        <img src="../../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>
</html>