<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Horários</title>
    <link rel="stylesheet" href="../../../style/style.css">
</head>
<body>
    <header class="headerPrincipal">
    <a href="../../../private/<?php if($_SESSION['tipo'] == 'admin'){echo 'admin/config/configAdmin.php';} else {echo 'user/config/configFuncionario.php';}?>"><img src="../../../assets/icons/header/engrenagemIcone.png" alt="Configurações"></a>
    <img src="../../../assets/logos/logoPequena.png" alt="Logo">
    <a href="../alertas.php"><img src="../../../assets/icons/header/sinoIcone.png" alt="Notificações"></a>
</header>

    <main>
        <section class="secaoInfo">
            <div id="tituloDados">
                <a href="dashboard.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt=""></a>
            <div class="textoCentral"><h2>HORÁRIOS</h2></div>
            </div>
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
    </section>
    </main>

    <footer class="footerPrincipal"> 
        <div class="barraLinhaSelecao">
            <div class="linhaAmarela linhaPos1"></div>
        </div>
        <div class="navbar">
            <a href="../../../private/user/dashboard/dashboard.php"><img src="../../../assets/icons/footer/dashboardIcone.png" alt="Dashboard"></a>
            <a href="../gerenciadorDeRotas/gerenciarRotas.php"><img src="../../../assets/icons/footer/rotasIcone.png" alt="Rotas"></a>
            <a href="../manutencao/manutencao.php"><img src="../../../assets/icons/footer/manutencaoIcone.png" alt="Manutenção"></a>
            <a href="../relatorios/relatorios.php"><img src="../../../assets/icons/footer/relatoriosIcone.png" alt="Relatórios"></a>
        </div>
    </footer>
</body>
</html>