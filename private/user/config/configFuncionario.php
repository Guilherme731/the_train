<?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';

if($_SESSION['tipo'] == 'admin'){
    header('location: ../../admin/config/configAdmin.php');
}

$id = $_SESSION['user_id'];
$temTFA = 0;
$sql = "SELECT temTFA FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $temTFA = $row['temTFA'];
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Configurações</title>
    <script src="../../../scripts/botoesMenus.js"></script>
    <link rel="stylesheet" href="../../../style/style.css">
</head>

<body>
    <header class="headerAzulVoltar">
        <a href="../dashboard/dashboard.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main class="mainCentral">
        <div>
            <h1 class="tituloAzul">Configurações</h1>
            <div id="quadradoMenu">
    
                <a href="../config/editaPerfilFuncionario.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/funcionarioIcone.png"
                        alt="Imagem do ícone de editar perfil">
                    <p>Conta</p>
                </a>
                <a href="idioma.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/idiomaIcone.png"
                        alt="Imagem do ícone de Conta">
                    <p>Idioma</p>
                </a>
                
                <?php if ($temTFA == 1): ?>
                    <a href="#" class="opcaoMenu" onclick="mostrarMensagemTFA(); return false;">
                    <img class="iconeConfigTamanho"
                    src="../../../assets/icons/config/verificacaoDuasEtapas/verificacao2EtapasIcone.png"
                    alt="Imagem do ícone de verificação de 2 etapas">
                    <p>Verificação de 2 etapas</p>
                    </a>
            
                <?php else: ?>
                    <a href="../../user/config/verificacaoDuasEtapas/verificacaode2etapas.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho"
                    src="../../../assets/icons/config/verificacaoDuasEtapas/verificacao2EtapasIcone.png"
                    alt="Imagem do ícone de verificação de 2 etapas">
                    <p>Verificação de 2 etapas</p>
                    </a>
                <?php endif; ?>

                <a href="<?php if($_SESSION['tipo'] == 'admin'){echo '../../admin/config/responderMensagens.php';} else {echo 'comunique.php';}?>" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/faleConoscoIcone.png"
                        alt="Imagem do ícone de Fale Conosco">
                    <p>Fale Conosco</p>
                </a>
                <a href="../../../public/sair.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/sair.png"
                        alt="Imagem do ícone de Fale Conosco">
                    <p>Encerrar Sessão</p>
                </a>
            </div>
        </div>
    <div class="espacoFooterPrincipal"></div>
    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>
<script>
    
function mostrarMensagemTFA() {
    document.getElementById('mensagemTFA').style.display = 'block';
}
function naoMensagemTFA() {
    document.getElementById('mensagemTFA').style.display = 'none';
}

function simMensagemTFA(){
 document.getElementById('mensagemTFA').style.display = 'none';
}
</script>
    <div id="mensagemTFA" class="mensagemCodigo">
        <p>Você já tem uma verificação de duas etapas, deseja deletar a atual?</p>
        <div class="flexCentro">
        <a href="../../user/config/verificacaoDuasEtapas/retirarTFA.php?id=<?= $id ?>" class="fechar">Sim</a>
        <p>ㅤㅤㅤㅤㅤㅤㅤㅤㅤ</p>
        <a href="#" class="fechar" onclick="naoMensagemTFA(); return false;">Não</a>
        </div>
     </div>
     <script>naoMensagemTFA();</script>

</html>