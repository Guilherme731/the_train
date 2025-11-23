    <?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';

$sqlTrensPadrao = 'SELECT id, idRota, nome FROM trens';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $resultTrensEdicao = $conn->query($sqlTrensPadrao);
    while($trem = $resultTrensEdicao->fetch_assoc()){
        $idNovaRota = $_POST['idRota' . $trem['id']];
        $stmt = $conn->prepare("UPDATE trens SET idRota = ? WHERE id = ?");
        $stmt->bind_param("ii", $idNovaRota, $trem['id']);
        $stmt->execute();
    }
    echo "<div class='mensagemErro'><p>Rotas atualizadas com sucesso.</p><a href='' class='fechar'>Fechar</a></div>";
    
}

$sqlTrens = 'SELECT trens.id AS idTrem, trens.idEstacao AS estacaoAtual, localizacaoX, localizacaoY, horaSaida, ordemRota, trens.idRota, rotas.id, rotasEstacoes.idRota, rotasEstacoes.idEstacao AS nextStop FROM trens INNER JOIN rotas ON trens.idRota = rotas.id INNER JOIN rotasEstacoes ON rotas.id = rotasEstacoes.idRota AND ordemRota = rotasestacoes.ordem';
$resultTrens = $conn->query($sqlTrens);


$resultTrensPadrao = $conn->query($sqlTrensPadrao);

$sqlRotas = 'SELECT id, nome FROM rotas ORDER BY id';
$resultRotas = $conn->query($sqlRotas);


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../style/style.css">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">

    <title>Gerenciador de rotas</title>
</head>

<body>

<header class="headerPrincipal">
    <a href="../../../private/<?php if($_SESSION['tipo'] == 'admin'){echo 'admin/config/configAdmin.php';} else {echo 'user/config/configFuncionario.php';}?>"><img src="../../../assets/icons/header/engrenagemIcone.png" alt="Configurações"></a>
    <img src="../../../assets/logos/logoPequena.png" alt="Logo">
    <a href="../alertas.php"><img src="../../../assets/icons/header/sinoIcone.png" alt="Notificações"></a>
</header>

    <main>
        <div id="mapa" class="flexCentro">
            <svg id="svgMapa">
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
                <rect x="135" y="00" width="20" height="20" class="quadradoMapa"/>
                <rect x="250" y="00" width="20" height="20" class="quadradoMapa"/>
                <rect x="330" y="65" width="20" height="20" class="quadradoMapaAmarelo"/>
                <rect x="190" y="65" width="20" height="20" class="quadradoMapa"/>
                <rect x="250" y="130" width="20" height="20" class="quadradoMapa"/>
                <rect x="75" y="130" width="40" height="20" class="quadradoMapaAmarelo"/>
                <rect x="0" y="65" width="20" height="20" class="quadradoMapaAmarelo"/>

            </svg>
        </div>
        

        <div class="flexCentro">
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox" id="ver-estacoes" onclick="atualizaOpcoesMapa()" checked>
                    <span class="slider"></span>
                </label>
                <label for="ver-estacoes">Ver Estações</label>
            </div>
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox" id="ver-trens" onclick="atualizaOpcoesMapa()" checked>
                    <span class="slider"></span>
                </label>
                <label for="ver-trens">Ver Trens</label>
            </div>
        </div>
        

        <div class="secaoInfo">
            <h2>TRENS</h2>
            <form action="" method="POST">
            <?php 
            while($row = $resultTrensPadrao->fetch_assoc()){
                $nomeSelect = 'idRota' . strval($row['id']);
                ?>
                <div class="dadoInfo padding-3">
                <a class="iconeDesligar" onclick="desligarTrem(0)"><img class="iconeDesligar" src="../../../assets/icons/dashboard/desligar.png"
                        alt="Icone de Desligar os Trens"></a>
                <h3 class="tituloTrem"><?= $row['nome'] ?></h3>
                <div class="parteDireitaGerenciador">
                    <select class="selecionarRota" id="selectRota<?= $row['id'] ?>" name="<?= $nomeSelect ?>">
                        <?php
                        // Para cada trem, buscar as rotas novamente
                        $resultRotasLocal = $conn->query($sqlRotas);
                        while($rowR = $resultRotasLocal->fetch_assoc()){
                            if($rowR['id'] == $row['idRota']){
                                echo "<option value='{$rowR['id']}' selected>{$rowR['nome']}</option>";
                            }else{
                                echo "<option value='{$rowR['id']}'>{$rowR['nome']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
                <?php
            }
            ?>

            <div class="textoDireita">
                <button type="submit" class="botaoAmarelo">
                    Aplicar
                </button>
            </div>
            </form>

        </div>

        <div class="secaoInfo">
            <h2>ROTAS</h2>
            <?php
            $resultRotas = $conn->query($sqlRotas);
            while($row = $resultRotas->fetch_assoc()){
                echo "<div class='dadoInfo padding-3'>
                <h3 class='tituloTrem'>{$row['nome']}</h3>
                <div class='parteDireitaGerenciador'>
                    <a href='editarRotas.php?id={$row['id']}'><img class='iconeEditarRota' src='../../../assets/icons/dashboard/editarRota.png'
                            alt='Icone de editar a Rota dos Trens'></a>
                </div>
            </div>";
            }
            ?>
            <a href="criarRota.php"><img class="iconeAddRotas" src="../../../assets/icons/dashboard/addRota.png" alt="Icone add rotas"></a>
        </div>
        




    </main>

    <div class="espacoFooterPrincipal"></div>

    <footer class="footerPrincipal">
        <div class="barraLinhaSelecao">
            <div class="linhaAmarela linhaPos2"></div>
        </div>
        <div class="navbar">
            <a href="../../../private/user/dashboard/dashboard.php"><img
                    src="../../../assets/icons/footer/dashboardIcone.png" alt="Dashboard"></a>
            <a href=""><img src="../../../assets/icons/footer/rotasIcone.png" alt="Rotas"></a>
            <a href="../manutencao/manutencao.php"><img src="../../../assets/icons/footer/manutencaoIcone.png"
                    alt="Manutenção"></a>
            <a href="../relatorios/relatorios.php"><img src="../../../assets/icons/footer/relatoriosIcone.png" alt="Relatórios"></a>
        </div>
    </footer>
    <script src="../../../scripts/gerenciamentoRotas/jsons/rotas.js"></script>
    <script src="../../../scripts/gerenciamentoRotas/jsons/trens.js"></script>
    <script src="../../../scripts/gerenciamentoRotas/gerenciadorMapa.js"></script>
    <script src="../../../scripts/gerenciamentoRotas/gerenciadorRotas.js"></script>

</body>

</html>