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
    <?php include '../includes/header/headerPadrao.php'; ?>

    <main>
        <section class="secaoInfo">
            <div id="tituloDados">
                <img src="../../assets/icons/header/setaEsquerda.png" alt="" onclick="voltarPagina()">
            <div class="textoCentral"><h2>ALERTAS</h2></div>
            </div>
            <div id="areaAlertas">
                <div id="semAlertas">Não há mensagens.</div>
            </div>
            <button onclick="fecharTodosAlertas()" class="botaoAmarelo">Fechar Tudo</button>
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
    <script src="../../scripts/alertas.js"></script>
</body>
</html>