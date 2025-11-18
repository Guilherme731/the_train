<?php
session_start();
include '../../authGuard/authUsuario.php';

if($_SESSION['tipo'] == 'admin'){
    header('location: ../../admin/config/configAdmin.php');
}
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
                <a href="../../user/config/verificacaoDuasEtapas/codigoVerificacao.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho"
                        src="../../../assets/icons/config/verificacaoDuasEtapas/verificacao2EtapasIcone.png"
                        alt="Imagem do ícone de verificação de 2 etapas">
                    <p>Verificação De 2 etapas</p>
                </a>

                <a href="<?php if($_SESSION['tipo'] == 'admin'){echo '../../admin/config/responderMensagens.php';} else {echo 'comunique.php';}?>" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/faleConoscoIcone.png"
                        alt="Imagem do ícone de Fale Conosco">
                    <p>Fale Conosco</p>
                </a>

                <a href="criarManutencao.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/iconeManutencao.png"
                        alt="Imagem do ícone de Manutenção">
                    <p>Manutenção</p>
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

</html>