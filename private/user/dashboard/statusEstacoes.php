<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Status dos Sensores</title>
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
            <div class="textoCentral"><h2>STATUS - SENSORES</h2></div>
            </div>
            
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
    </section>
    </main>

    <footer class="footerPrincipal"> 
        <div class="barraLinhaSelecao">
            <div class="linhaAmarela linhaPos1"></div>
        </div>
        <div class="navbar">
            <a href="../dashboard/dashboard.php"><img src="../../../assets/icons/footer/dashboardIcone.png" alt="Dashboard"></a>
            <a href="../gerenciadorDeRotas/gerenciarRotas.php"><img src="../../../assets/icons/footer/rotasIcone.png" alt="Rotas"></a>
            <a href="../manutencao/manutencao.php"><img src="../../../assets/icons/footer/manutencaoIcone.png" alt="Manutenção"></a>
            <a href="../relatorios/relatorios.php"><img src="../../../assets/icons/footer/relatoriosIcone.png" alt="Relatórios"></a>
        </div>
    </footer>
</body>
</html>