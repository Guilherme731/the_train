<?php
session_start();
include '../../authGuard/authAdmin.php';
include '../../conexao/conexao.php';

$id = $_SESSION['user_id'];

$sqlMensagens = "SELECT mensagens.id, mensagens.id_remetente, mensagens.tipo, mensagens.id_destinatario, mensagens.conteudo, mensagens.data_envio FROM mensagens INNER JOIN usuarios ON mensagens.id_remetente = usuarios.id WHERE mensagens.id_destinatario = $id";
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
        <a href="configAdmin.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>
    
    <section class="secaoInfo">
            <div class="textoCentral"><h2>MENSAGENS</h2></div>
            <div id="areaAlertas">
            <?php
            if($reultMensagens->num_rows > 0){
              while ($row = $reultMensagens->fetch_assoc()){
                $nomeTipo = $row['tipo'];
                    $tipo = 'duvida';
                if($nomeTipo == 'reportarErro'){
                    $tipo = 'erro';
                }elseif($nomeTipo == 'marcarAudiencia'){
                    $tipo = 'audiencia';
                }
                $conteudo = $row['conteudo'];
                $data = $row['data_envio'];
                $idMensagem = $row['id'];
                $destinatario = $row['id_destinatario'];

                echo "<div class='alerta'>
                <div class='textoEsquerda'>
                    <p class='mensagemPrincipal margin-0'>" . $nomeTipo . "</p>
                    <p class='mensagemSecundaria margin-0'>$conteudo</p>
                </div>
                <div class='finalAlerta'>
                    <a href='fecharMensagem.php?ida=$idMensagem'><img src='../../../assets/icons/alertas/fecharIcone.png'></a>
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
            <a href="fecharTodasMensagens.php" class="botaoAmarelo">Fechar Tudo</a>
        </section>






    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>
</html>