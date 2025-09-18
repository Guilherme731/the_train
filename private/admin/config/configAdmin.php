<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../style/style.css">
    <script src="../../../scripts/botoesMenus.js"></script>
    <title>Configurações admin</title>

</head>

<body>
    <header class="headerAzulVoltar">
        <a href="../../user/dashboard/dashboard.php">
            <img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
        </a>
    </header>

    <main class="mainCentral">
        <div>
            <h1 class="tituloAzul">Configurações - Admin</h1>
            <div id="quadradoMenu">

                <a href="../../user/config/editaPerfilFuncionario.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/funcionarioIcone.png"
                        alt="Imagem do ícone de editar perfil">
                    <p>Conta</p>
                </a>
                <a href="../../user/config/idioma.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/idiomaIcone.png"
                        alt="Imagem do ícone de Conta">
                    <p>Idioma</p>
                </a>
                <a href="../../user/config/verificacaoDuasEtapas/entradaEmail.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho"
                        src="../../../assets/icons/config/verificacaoDuasEtapas/verificacao2EtapasIcone.png"
                        alt="Imagem do ícone de verificação de 2 etapas">
                    <p>Verificação De 2 etapas</p>
                </a>
                <a href="../../user/config/faleConosco/faleConosco.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/faleConoscoIcone.png"
                        alt="Imagem do ícone de Fale Conosco">
                    <p>Fale Conosco</p>
                </a>

                </a>
                <a href="../../admin/config/cadastrarFuncionario.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/addFuncionarioIcone.png"
                        alt="Imagem do ícone de Criar Usuario">
                    <p>Criar Usuário</p>
                </a>

                </a>
                <a href="../../admin/config/editarPerfilUsuario.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/editarFuncionarioIcone.png"
                        alt="Imagem do ícone de Editar Usuário">
                    <p>Editar Usuário</p>
                </a>
                <a href="../../../public/sair.php" class="opcaoMenu">
                    <img class="iconeConfigTamanho" src="../../../assets/icons/config/sair.png"
                        alt="Imagem do ícone de Fale Conosco">
                    <p>Encerrar Sessão</p>
                </a>
            </div>
        </div>
    </main>

    <div class="espacoFooterAzulLogo"></div>
    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>

</html>