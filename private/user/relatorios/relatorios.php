<?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';

//Gráfico de Eficiência
$sql = 'SELECT AVG(notaConforto) AS mediaConforto, AVG(notaLimpeza) AS mediaLimpeza, AVG(notaVistoria) AS mediaVistoria FROM avaliacoes';
$result = $conn->query($sql);

$dados = [];

$dados[] = ["Element", "Série", ["role" => "style"]];

$row = $result->fetch_assoc();
$dados[] = ['Conforto', (int)$row['mediaConforto'], '#35e6eb'];
$dados[] = ['Limpeza', (int)$row['mediaLimpeza'], '#5fc3f4'];
$dados[] = ['Vistoria', (int)$row['mediaVistoria'], '#31356e'];

echo "<script>var dadoseficienciaPHP = " . json_encode($dados) . ";</script>";

//Gráfico de Energia
$sql = "SELECT nome, consumo FROM trens";
$result = $conn->query($sql);

$dados = [];
$dados[] = ["Trem", "Consumo (kWh)", ["role" => "style"]];

$cores = ["#35e6eb", "#5fc3f4", "#5cc0cd"];
$i = 0;

while ($row = $result->fetch_assoc()) {
    $dados[] = [
        $row['nome'], 
        (float)$row['consumo'], 
        $cores[$i % count($cores)] 
    ];
    $i++;
}
echo "<script>var dadosenergiaPHP = " . json_encode($dados) . ";</script>";

//Gráfico de desempenho

$sql = "SELECT nome, desempenho FROM trens";
$result = $conn->query($sql);

$dados = [];
$dados[] = ["Trem", "% de viagens sem atraso", ["role" => "style"]];

$cores = ["#35e6eb", "#5fc3f4", "#5cc0cd"];
$i = 0;

while ($row = $result->fetch_assoc()) {
    $dados[] = [
        $row['nome'], 
        (float)$row['desempenho'], 
        $cores[$i % count($cores)] 
    ];
    $i++;
}
echo "<script>var dadosdesempenhoPHP = " . json_encode($dados) . ";</script>";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Relatorios</title>
    <link rel="stylesheet" href="../../../style/style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="../../../scripts/graficos/graficoDesempenho.js"></script>
    <script src="../../../scripts/graficos/graficoEnergia.js"></script>
    <script src="../../../scripts/graficos/graficoEficiencia.js"></script>
</head>
<body>

<header class="headerPrincipal">
    <a href="../../../private/<?php if($_SESSION['tipo'] == 'admin'){echo 'admin/config/configAdmin.php';} else {echo 'user/config/configFuncionario.php';}?>"><img src="../../../assets/icons/header/engrenagemIcone.png" alt="Configurações"></a>
    <img src="../../../assets/logos/logoPequena.png" alt="Logo">
    <a href="../alertas.php"><img src="../../../assets/icons/header/sinoIcone.png" alt="Notificações"></a>
</header>

    <main class="flexCentro">
        <div>
            
            <div>
                <div class="relatorioFundosCima flexCentro">
                    <p>Dados de desempenho</p>
                </div>
                <div class="relatorioFundos">
                    <div id="columnchart_values3"></div>
                </div>

            </div>

            <div class="relatorioFundosCima flexCentro">
                <p>Consumo de Energia</p>
            </div>
            <div>
            </div>
            <div class="relatorioFundos">
                <div id="columnchart_values2"></div>
            </div>

            <div class="centralizacaoRelatorioFundo">
            </div>
            <div class="relatorioFundosCima flexCentro">
                <p>Eficiência operacional</p>
            </div>
            <div class="relatorioFundos">
                <div id="columnchart_values"></div>
            </div>

    </main>

    <div class="espacoFooterPrincipal"></div>

    <footer class="footerPrincipal">
        <div class="barraLinhaSelecao">
            <div class="linhaAmarela linhaPos4"></div>
        </div>
        <div class="navbar">
            <a href="../dashboard/dashboard.php"><img src="../../../assets/icons/footer/dashboardIcone.png" alt="Dashboard"></a>
            <a href="../gerenciadorDeRotas/gerenciarRotas.php"><img src="../../../assets/icons/footer/rotasIcone.png" alt="Rotas"></a>
            <a href="../manutencao/manutencao.php"><img src="../../../assets/icons/footer/manutencaoIcone.png" alt="Manutenção"></a>
            <a href="relatorios.php"><img src="../../../assets/icons/footer/relatoriosIcone.png" alt="Relatórios"></a>
        </div>
    </footer>
</body>
</html>