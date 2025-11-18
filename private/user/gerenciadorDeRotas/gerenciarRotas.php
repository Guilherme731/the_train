    <?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';

$sqlTrens = 'SELECT trens.id AS idTrem, trens.idEstacao AS estacaoAtual, localizacaoX, localizacaoY, horaSaida, ordemRota, trens.idRota, rotas.id, rotasEstacoes.idRota, rotasEstacoes.idEstacao AS nextStop FROM trens INNER JOIN rotas ON trens.idRota = rotas.id INNER JOIN rotasEstacoes ON rotas.id = rotasEstacoes.idRota AND ordemRota = rotasestacoes.ordem';
$resultTrens = $conn->query($sqlTrens);
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
        <?php
echo "<script>

document.addEventListener('DOMContentLoaded', function() {";
while($row = $resultTrens->fetch_assoc()){
    $posX = 0;
    $posY = 0;
    $VEL_X = 8;
    if($row['nextStop'] == 3 && $row['estacaoAtual'] == 2){
        

        $horaSaida = $row['horaSaida'];
        $now = new DateTime();
        if(preg_match('/^\d{1,2}:\d{2}$/', $horaSaida)){
            $horaSaida .= ':00';
        }
       if(preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $horaSaida)){
            list($h, $m, $s) = explode(':', $horaSaida);
            $saidaSeconds = (intval($h) + 4) * 3600 + intval($m) * 60 + intval($s);

            $now = new DateTime();
            $nowSeconds = intval($now->format('H')) * 3600 + intval($now->format('i')) * 60 + intval($now->format('s'));

            $diff = $nowSeconds - $saidaSeconds;
            $posX = $diff * $VEL_X;

            if($posX<=5){
                $posX = 5;
                $posY = 65;
            }else if($posX <= 65){
                $posY = 65 - sqrt(3600-(pow(($posX-65),2)));
            }else if ($posX > 265 && $posX < 330){
                $posY = 65 - sqrt(3600-(pow((($posX - 200)-65),2)));
            }else if($posX >= 329){
                $posX = 330;
                $posY = 65;
            }else{
                $posY = 5;
            }
            
        } else {
            $posX = 0;
        }
    }
    if($row['nextStop'] == 2 && $row['estacaoAtual'] == 3){
        

        $horaSaida = $row['horaSaida'];
        $now = new DateTime();
        if(preg_match('/^\d{1,2}:\d{2}$/', $horaSaida)){
            $horaSaida .= ':00';
        }
       if(preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $horaSaida)){
            list($h, $m, $s) = explode(':', $horaSaida);
            $saidaSeconds = (intval($h) + 4) * 3600 + intval($m) * 60 + intval($s);

            $now = new DateTime();
            $nowSeconds = intval($now->format('H')) * 3600 + intval($now->format('i')) * 60 + intval($now->format('s'));

            $diff = $nowSeconds - $saidaSeconds;
            $posX = (330 - $diff * $VEL_X);

            if($posX<=5){
                $posX = 5;
                $posY = 65;
            }else if($posX <= 65){
                $posY = 65 - sqrt(3600-(pow(($posX-65),2)));
            }else if ($posX > 265 && $posX < 330){
                $posY = 65 - sqrt(3600-(pow((($posX - 200)-65),2)));
            }else if($posX >= 329){
                $posX = 330;
                $posY = 65;
            }else{
                $posY = 5;
            }
            
        } else {
            $posX = 0;
        }
    }
    if($row['nextStop'] == 3 && $row['estacaoAtual'] == 3){
        

        $horaSaida = $row['horaSaida'];
        $now = new DateTime();
        if(preg_match('/^\d{1,2}:\d{2}$/', $horaSaida)){
            $horaSaida .= ':00';
        }
       if(preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $horaSaida)){
            list($h, $m, $s) = explode(':', $horaSaida);
            $saidaSeconds = (intval($h) + 4) * 3600 + intval($m) * 60 + intval($s);

            $now = new DateTime();
            $nowSeconds = intval($now->format('H')) * 3600 + intval($now->format('i')) * 60 + intval($now->format('s'));

            $diff = $nowSeconds - $saidaSeconds;
            if($diff <= 0 || ($diff * $VEL_X) > 330){
                $posX = 330;
            }
            else if (($diff * $VEL_X) <= 130) {
    // FASE 1: Diminuindo de 330 para 200
    // posX vai de 330 (diff=0) a 200 (diff=130)
    $posX = (330 - ($diff * $VEL_X));
} else {
    // FASE 2: Aumentando de 200 em diante
    // O movimento de retorno deve usar (diff - 130)
    // Para retornar a 330, a lógica é: 200 + (diff - 130)
    $posX = (200 + (($diff * $VEL_X) - 130));
}
            
            if($posX<=0){
                $posX = 330;
                $posY = 65;
            }else if($posX <= 265 && ($diff * $VEL_X) < 130 && $posX < 330 && $posX > 0){
                $posY = 65 + sqrt(3600-(pow((($posX-200)-65),2)));
            }else if ($posX > 265 && ($diff * $VEL_X) < 130 && $posX < 330 && $posX > 0){
                $posY = 65 + sqrt(3600-(pow((($posX - 200)-65),2)));
            }else if ($posX <= 265 && ($diff * $VEL_X) > 130 && $posX < 330 && $posX > 0){
                $posY = 65 - sqrt(3600-(pow((($posX - 200)-65),2)));
            }else if ($posX > 265 && ($diff * $VEL_X) > 130 && $posX < 330 && $posX > 0){
                $posY = 65 - sqrt(3600-(pow((($posX - 200)-65),2)));
            }else{
                $posY = 65;
            }
            
        } else {
            $posX = 0;
        }
    }
    echo "addQuadradoTrem($posX, $posY, {$row['idTrem']});";
}
    
echo "});
</script>";
?>

        <div class="flexCentro">
            <div class="switch-container">
                <label class="switch">
                    <input type="checkbox" id="ver-estacoes" onclick="atualizaOpcoesMapa()" checked>
                    <span class="slider"></span>
                </label>
                <label for="ver-estacoes">Ver Estações</label>
            </div>
        <a href="">Atualizar Mapa</a>
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
            <div class="dadoInfo padding-3">
                <a class="iconeDesligar" onclick="desligarTrem(0)"><img class="iconeDesligar" src="../../../assets/icons/dashboard/desligar.png"
                        alt="Icone de Desligar os Trens"></a>
                <h3 class="tituloTrem">Trem 1</h3>
                <div class="parteDireitaGerenciador">
                    <a class="iconeVisualizarRota"  onclick="mostraTremEspecifico(0)"><img class="iconeVisualizarRota"
                            src="../../../assets/icons/dashboard/visualizar.png" alt="Icone de Visualizar a Rota dos Trens"></a>
        
                    <select class="selecionarRota" id="selectRota1">
                        <option value="rota1">Rota 1</option>
                        <option value="rota2">Rota 2</option>
                        <option value="rota3">Rota 3</option>
                    </select>
                </div>
            </div>

            <div class="dadoInfo padding-3">
                <a class="iconeDesligar" onclick="desligarTrem(1)"><img class="iconeDesligar" src="../../../assets/icons/dashboard/desligar.png"
                        alt="Icone de Desligar os Trens"></a>
                <h3 class="tituloTrem">Trem 2</h3>
                <div class="parteDireitaGerenciador">
                    <a class="iconeVisualizarRota"   onclick="mostraTremEspecifico(1)"><img class="iconeVisualizarRota"
                            src="../../../assets/icons/dashboard/visualizar.png" alt="Icone de Visualizar a Rota dos Trens"></a>
        
                    <select class="selecionarRota" id="selectRota2">
                        <option value="rota1">Rota 1</option>
                        <option value="rota2">Rota 2</option>
                        <option value="rota3">Rota 3</option>
                    </select>
                </div>
            </div>

            <div class="dadoInfo padding-3">
                <a class="iconeDesligar" onclick="desligarTrem(2)"><img class="iconeDesligar" src="../../../assets/icons/dashboard/desligar.png"
                        alt="Icone de Desligar os Trens"></a>
                <h3 class="tituloTrem">Trem 3</h3>
                <div class="parteDireitaGerenciador">
                    <a class="iconeVisualizarRota"   onclick="mostraTremEspecifico(2)"><img class="iconeVisualizarRota"
                            src="../../../assets/icons/dashboard/visualizar.png" alt="Icone de Visualizar a Rota dos Trens"></a>
        
                    <select class="selecionarRota" id="selectRota3">
                        <option value="rota1">Rota 1</option>
                        <option value="rota2">Rota 2</option>
                        <option value="rota3">Rota 3</option>
                    </select>
                </div>
            </div>

            <div class="textoDireita">
                <button onclick="aplicarRotas()" class="botaoAmarelo">
                    Aplicar
                </button>
            </div>
            

        </div>

        <div class="secaoInfo">
            <h2>ROTAS</h2>

            <div class="dadoInfo padding-3">
                <h3 class="tituloTrem">Rota 1</h3>
                <div class="parteDireitaGerenciador">
                    <a onclick="visualizarRota(0)"><img class="iconeVisualizarRota" src="../../../assets/icons/dashboard/visualizar.png"
                        alt="Icone de Visualizar a Rota dos Trens"></a>
        
                    <a onclick="abrirEdicaoRota(0)"><img class="iconeEditarRota" src="../../../assets/icons/dashboard/editarRota.png"
                            alt="Icone de editar a Rota dos Trens"></a>
                </div>
            </div>

            <div class="dadoInfo padding-3">
                <h3 class="tituloTrem">Rota 2</h3>
                <div class="parteDireitaGerenciador">
                    <a onclick="visualizarRota(1)"><img class="iconeVisualizarRota" src="../../../assets/icons/dashboard/visualizar.png"
                        alt="Icone de Visualizar a Rota dos Trens"></a>
        
                    <a onclick="abrirEdicaoRota(1)"><img class="iconeEditarRota" src="../../../assets/icons/dashboard/editarRota.png"
                            alt="Icone de editar a Rota dos Trens"></a>
                </div>
            </div>
            

            <div class="dadoInfo padding-3">
                <h3 class="tituloTrem">Rota 3</h3>
                <div class="parteDireitaGerenciador">
                    <a onclick="visualizarRota(2)"><img class="iconeVisualizarRota" src="../../../assets/icons/dashboard/visualizar.png"
                        alt="Icone de Visualizar a Rota dos Trens"></a>
        
                    <a onclick="abrirEdicaoRota(2)"><img class="iconeEditarRota" src="../../../assets/icons/dashboard/editarRota.png"
                            alt="Icone de editar a Rota dos Trens"></a>
                </div>
            </div>
            <img class="iconeAddRotas" src="../../../assets/icons/dashboard/addRota.png" alt="Icone add rotas" onclick="criarRota()">
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