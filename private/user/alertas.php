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
        <a href="../../private/user/config/configFuncionario.html"><img src="../../assets/icons/header/engrenagemIcone.png" alt="Configurações"></a>
        <img src="../../assets/logos/logoPequena.png" alt="Logo">
        <a href="alertas.html"><img src="../../assets/icons/header/sinoIcone.png" alt="Notificações"></a>
    </header>

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
            <a href="../../private/user/dashboard/dashboard.html"><img src="../../assets/icons/footer/dashboardIcone.png" alt="Dashboard"></a>
            <a href="../../private/user/gerenciadorDeRotas/gerenciarRotas.html"><img src="../../assets/icons/footer/rotasIcone.png" alt="Rotas"></a>
            <a href="../../private/user/manutencao/manutencao.html"><img src="../../assets/icons/footer/manutencaoIcone.png" alt="Manutenção"></a>
            <a href="../../private/user/relatorios/relatorios.html"><img src="../../assets/icons/footer/relatoriosIcone.png" alt="Relatórios"></a>
        </div>
    </footer>
    <script src="../../scripts/alertas.js"></script>
</body>
</html>