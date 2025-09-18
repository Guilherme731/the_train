<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../style/style.css">
    <title>Editar Rotas</title>
</head>

<body>
    
<header class="headerPrincipal">
    <a href="../../../private/<?php if($_SESSION['tipo'] == 'admin'){echo 'admin/config/configAdmin.php';} else {echo 'user/config/configFuncionario.php';}?>"><img src="../../../assets/icons/header/engrenagemIcone.png" alt="Configurações"></a>
    <img src="../../../assets/logos/logoPequena.png" alt="Logo">
    <a href="../alertas.php"><img src="../../../assets/icons/header/sinoIcone.png" alt="Notificações"></a>
</header>

    <main>

        <div id="mapa" class="flexCentro">
            <svg id="svgMapaEditar">
                <!-- d= M posicaoHI posicaoVI Q posicaoHM posicaoVM posicaoHF posicaoVF -->
                <!-- d= M posicaoHI posicaoVI posicaoHF posicaoVF -->
                <!-- C -> Curva   R -> Reta  | D -> Direita  E -> Esquerda   C -> Central |  S-> Superior  I -> Inferior -->

                <!-- Linhas perimetrais -->
                <path id="linhaCES" class="linhaMapa" d="M 10 75 Q 10 10 90 10" />
                <path id="linhaCEI" class="linhaMapa" d="M 90 140 Q 10 140 10 75" />
                <path id="linhaRCI" class="linhaMapa" d="M 90 140 260 140" />
                <path id="linhaCDI" class="linhaMapa" d="M 260 140 Q 340 140 340 75" />
                <path id="linhaCDS" class="linhaMapa" d="M 340 75 Q 340 10 260 10" />
                <path id="linhaRCS" class="linhaMapa" d="M 145 10 260 10" />
                <path id="linhaRES" class="linhaMapa" d="M 90 10 145 10" />

                <!-- Linhas interiores -->
                <path id="linhaRCI" class="linhaMapa" d="M 170 140 110 75" />
                <path id="linhaCCI" class="linhaMapa" d="M 260 140 Q 200 130 200 75" />
                <path id="linhaCCS" class="linhaMapa" d="M 260 10 Q 200 20 200 75" />

                <!-- Quadrados (e retângulos) -->
                <rect x="135" y="00" width="20" height="20" class="quadradoMapa" />
                <rect x="250" y="00" width="20" height="20" class="quadradoMapa" />
                <rect x="330" y="65" width="20" height="20" class="quadradoMapa" />
                <rect x="190" y="65" width="20" height="20" class="quadradoMapa" />
                <rect x="250" y="130" width="20" height="20" class="quadradoMapa" />
                <rect x="75" y="130" width="40" height="20" class="quadradoMapa" />

            </svg>
        </div>
        <h2 class="tituloAzul" id="tituloPagina">Editar Rota</h2>
        <p class="textoCentral textSize-10">Deseja editar outra rota? <br> <a class="textoAzulEscuro"
                href="gerenciarRotas.html">Selecione outra</a></p>

        <div id="listaEstacoes">
            
        </div>



        <img onclick="criarElementoEstacao()" class="iconeAddRota" src="../../../assets/icons/dashboard/botaoAdd.png" alt="Botão add rotas">



    </main>

    <footer class="footerPrincipal">
        <div class="barraLinhaSelecao">
            <div class="linhaAmarela linhaPos2"></div>
        </div>
        <div class="navbar">
            <a href="../../../private/user/dashboard/dashboard.html"><img
                    src="../../../assets/icons/footer/dashboardIcone.png" alt="Dashboard"></a>
            <a href=""><img src="../../../assets/icons/footer/rotasIcone.png" alt="Rotas"></a>
            <a href="../manutencao/manutencao.html"><img src="../../../assets/icons/footer/manutencaoIcone.png"
                    alt="Manutenção"></a>
            <a href="../relatorios/relatorios.html"><img src="../../../assets/icons/footer/relatoriosIcone.png"
                    alt="Relatórios"></a>
        </div>
    </footer>

    <script src="../../../scripts/gerenciamentoRotas/jsons/rotas.js"></script>
    <script src="../../../scripts/gerenciamentoRotas/gerenciadorMapa.js"></script>
    <script src="../../../scripts/gerenciamentoRotas/editarRotas.js"></script>

</body>

</html>