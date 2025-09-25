<?php
session_start();
include '../../authGuard/authUsuario.php';
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
    <section class="secaoInfo">
        <h2>HORÁRIOS</h2>
        <div class="dadoInfo dashboard">
            <div class="dadoInfoLeft">
                <p class="textoPrincipalDado">TREM 1</p>
                <p class="textoSecundarioDado">Saiu as 12:23</p>
            </div>
            <div class="dadoInfoCenter">
                <img src="../../../assets/icons/dashboard/trafegandoIcone.png" alt="iconeTrafegando">
            </div>
            <div class="dadoInfoRight">
                <p class="textoPrincipalDado">ESTAÇÃO 2</p>
                <p class="textoSecundarioDado">Chega as 12:31</p>
            </div>
    
        </div>
        <div class="dadoInfo dashboard">
            <div class="dadoInfoLeft">
                <p class="textoPrincipalDado">TREM 2</p>
                <p class="textoSecundarioDado">Embarcando...</p>
            </div>
            <div class="dadoInfoCenter">
                <img src="../../../assets/icons/dashboard/paradoIcone.png" alt="iconeParado">
            </div>
            <div class="dadoInfoRight">
                <p class="textoPrincipalDado">ESTAÇÃO 1</p>
                <p class="textoSecundarioDado">Sai as 12:27</p>
            </div>
    
        </div>
        <div class="dadoInfo dashboard">
            <div class="dadoInfoLeft">
                <p class="textoPrincipalDado">TREM 3</p>
                <p class="textoSecundarioDado">Saiu as 12:24</p>
            </div>
            <div class="dadoInfoCenter">
                <img src="../../../assets/icons/dashboard/trafegandoIcone.png" alt="iconeTrafegando">
            </div>
            <div class="dadoInfoRight">
                <p class="textoPrincipalDado">ESTAÇÃO 1</p>
                <p class="textoSecundarioDado">Chega as 12:35</p>
            </div>
    
        </div>
        <div class="textoDireita">
            <a href="horarios.php" class="botaoAmarelo">Ver Tudo</a>
        </div>
    
    </section>

    <section class="secaoInfo">
        <h2>STATUS - TRENS</h2>
        <div class="dadoStatusTrens">
            <div class="tremStatus1">
                <img src="../../../assets/icons/dashboard/circuloVerdeIcone.png" alt="simboloStatusVerde">
                <p>TREM 1</p>
            </div>
            <div class="tremStatus2">
                <img src="../../../assets/icons/dashboard/velocidadeIcone.png" alt="simboloVelocidade">
                <p>102</p>
                <p class="textSize-10">Km/h</p>
            </div>
            <div class="tremStatus3">
                <img src="../../../assets/icons/dashboard/pessoaIcone.png" alt="simboloPessoa">
                <p>34</p>
            </div>
            <div class="tremStatus4">
                <p>ROTA 1</p>
            </div>
        </div>
        <div class="dadoStatusTrens">
            <div class="tremStatus1">
                <img src="../../../assets/icons/dashboard/circuloVerdeIcone.png" alt="simboloStatusVerde">
                <p>TREM 2</p>
            </div>
            <div class="tremStatus2">
                <img src="../../../assets/icons/dashboard/velocidadeIcone.png" alt="simboloVelocidade">
                <p>0</p>
                <p class="textSize-10">Km/h</p>
            </div>
            <div class="tremStatus3">
                <img src="../../../assets/icons/dashboard/pessoaIcone.png" alt="simboloPessoa">
                <p>23</p>
            </div>
            <div class="tremStatus4">
                <p>ROTA 4</p>
            </div>
        </div>
        <div class="dadoStatusTrens">
            <div class="tremStatus1">
                <img src="../../../assets/icons/dashboard/circuloVerdeIcone.png" alt="simboloStatusVerde">
                <p>TREM 3</p>
            </div>
            <div class="tremStatus2">
                <img src="../../../assets/icons/dashboard/velocidadeIcone.png" alt="simboloVelocidade">
                <p>87</p>
                <p class="textSize-10">Km/h</p>
            </div>
            <div class="tremStatus3">
                <img src="../../../assets/icons/dashboard/pessoaIcone.png" alt="simboloPessoa">
                <p>45</p>
            </div>
            <div class="tremStatus4">
                <p>ROTA 2</p>
            </div>
        </div>
        <div class="textoDireita">
            <a href="statusTrens.php" class="botaoAmarelo">Ver Tudo</a>
        </div>
    </section>

    <section  class="secaoInfo">
        <h2>STATUS - ESTAÇÕES</h2>
        <div class="dadoStatusEstacoes">
            <div>
                <img src="../../../assets/icons/dashboard/circuloVerdeIcone.png" alt="simboloStatusVerde">
                <p>ESTAÇÃO 1</p>
            </div>
            <div>
                <div class="iconeETempStatusEstacoes"><img src="../../../assets/icons/dashboard/chuvaIcone.png" alt="Ícone de chuva"></div>
                <div class="iconeETempStatusEstacoes"><img src="../../../assets/icons/dashboard/comTremIcone.png" alt="Ícone de trem"></div>
                <p class="iconeETempStatusEstacoes">23ºC</p>
            </div>
        </div>
        <div class="dadoStatusEstacoes">
            <div>
                <img src="../../../assets/icons/dashboard/circuloVerdeIcone.png" alt="simboloStatusVerde">
                <p>ESTAÇÃO 2</p>
            </div>
            <div>
                <div class="iconeETempStatusEstacoes"><img src="../../../assets/icons/dashboard/chuvaIcone.png" alt="Ícone de chuva"></div>
                <div class="iconeETempStatusEstacoes"><img src="../../../assets/icons/dashboard/semTremIcone.png" alt="Ícone de sem trem"></div>
                <p class="iconeETempStatusEstacoes">25ºC</p>
            </div>
        </div>
        <div class="dadoStatusEstacoes">
            <div>
                <img src="../../../assets/icons/dashboard/circuloVerdeIcone.png" alt="simboloStatusVerde">
                <p>ESTAÇÃO 3</p>
            </div>
            <div>
                <div class="iconeETempStatusEstacoes"><img src="../../../assets/icons/dashboard/solIcone.png" alt="Ícone de sol"></div>
                <div class="iconeETempStatusEstacoes"><img src="../../../assets/icons/dashboard/semTremIcone.png" alt="Ícone de sem trem"></div>
                <p class="iconeETempStatusEstacoes">22ºC</p>
            </div>
        </div>
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