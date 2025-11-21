<?php
session_start();
include '../../conexao/conexao.php';
$idRota = intval($_GET['idRota'] ?? 0);
$idEstacao = intval($_GET['idEstacao'] ?? 0);
$ordemAtual = intval($_GET['ordemAtual'] ?? 0);
$operacao = $_GET['operacao'] ?? '';

if ($idRota <= 0 || $ordemAtual <= 0) {
    $_SESSION['rota_msg'] = 'Parâmetros inválidos.';
    header("Location: editarRotas.php?id=$idRota");
    exit;
}

$resMax = $conn->query("SELECT MAX(ordem) AS maxOrdem FROM rotasEstacoes WHERE idRota = $idRota");
$maxOrdem = ($resMax && ($r = $resMax->fetch_assoc())) ? intval($r['maxOrdem']) : 0;

function renumerarOrdens($conn, $idRota) {
    $sql = "SELECT idEstacao, ordem FROM rotasEstacoes WHERE idRota = $idRota ORDER BY ordem";
    $res = $conn->query($sql);
    $i = 1;
    while ($row = $res->fetch_assoc()) {
        $idEst = intval($row['idEstacao']);
        $conn->query("UPDATE rotasEstacoes SET ordem = $i WHERE idRota = $idRota AND idEstacao = $idEst");
        $i++;
    }
}

if ($operacao === 'subir' || $operacao === 'descer') {
    $novaOrdem = ($operacao === 'subir') ? $ordemAtual - 1 : $ordemAtual + 1;
    if ($novaOrdem < 1 || $novaOrdem > $maxOrdem) {
        $_SESSION['rota_msg'] = ($operacao === 'subir') ? 'Não é possível subir: já é a primeira estação.' : 'Não é possível descer: já é a última estação.';
        header("Location: editarRotas.php?id=$idRota");
        exit;
    }

    $sqlAtual = "SELECT idEstacao FROM rotasEstacoes WHERE idRota = $idRota AND ordem = $ordemAtual LIMIT 1";
    $sqlAlvo = "SELECT idEstacao FROM rotasEstacoes WHERE idRota = $idRota AND ordem = $novaOrdem LIMIT 1";
    $rowAtual = $conn->query($sqlAtual)->fetch_assoc();
    $rowAlvo = $conn->query($sqlAlvo)->fetch_assoc();
    if (!$rowAtual || !$rowAlvo) {
        $_SESSION['rota_msg'] = 'Operação inválida: não foi possível identificar as estações.';
        header("Location: editarRotas.php?id=$idRota");
        exit;
    }

    $conn->begin_transaction();
    try {
        $conn->query("UPDATE rotasEstacoes SET ordem = 0 WHERE idRota = $idRota AND ordem = $novaOrdem");
        $conn->query("UPDATE rotasEstacoes SET ordem = $novaOrdem WHERE idRota = $idRota AND ordem = $ordemAtual");
        $conn->query("UPDATE rotasEstacoes SET ordem = $ordemAtual WHERE idRota = $idRota AND ordem = 0");
        $conn->commit();
        $_SESSION['rota_msg'] = 'Ordem atualizada com sucesso.';
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['rota_msg'] = 'Erro ao atualizar a ordem.';
    }

    header("Location: editarRotas.php?id=$idRota");
    exit;
}

if ($operacao === 'excluir') {
    $conn->begin_transaction();
    try {
        $conn->query("DELETE FROM rotasEstacoes WHERE idRota = $idRota AND ordem = $ordemAtual");
        renumerarOrdens($conn, $idRota);
        $conn->commit();
        $_SESSION['rota_msg'] = 'Estação removida e ordens renumeradas.';
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['rota_msg'] = 'Erro ao remover estação.';
    }
    header("Location: editarRotas.php?id=$idRota");
    exit;
}

// Por padrão redireciona
$_SESSION['rota_msg'] = 'Operação não reconhecida.';
header("Location: editarRotas.php?id=$idRota");
exit;
