<?php
session_start();
include '../../conexao/conexao.php';

// Aceita: idRota (obrigatório) e uma das chaves: ordem ou idEstacao
$idRota = intval($_GET['idRota'] ?? 0);
$ordem = isset($_GET['ordem']) ? intval($_GET['ordem']) : 0;
$idEstacao = isset($_GET['idEstacao']) ? intval($_GET['idEstacao']) : 0;

if ($idRota <= 0) {
    $_SESSION['rota_msg'] = 'Parâmetros inválidos.';
    header("Location: editarRotas.php?id=$idRota");
    exit;
}

function renumerarOrdens($conn, $idRota) {
    $sql = "SELECT idEstacao, ordem FROM rotasEstacoes WHERE idRota = $idRota ORDER BY ordem";
    $res = $conn->query($sql);
    $rows = [];
    while ($row = $res->fetch_assoc()) {
        $rows[] = $row;
    }

    $i = 1;
    foreach ($rows as $r) {
        $oldOrder = intval($r['ordem']);
        $idEst = intval($r['idEstacao']);
        $temp = -$i;
        $conn->query("UPDATE rotasEstacoes SET ordem = $temp WHERE idRota = $idRota AND idEstacao = $idEst AND ordem = $oldOrder");
        $i++;
    }

    $i = 1;
    foreach ($rows as $r) {
        $temp = -$i;
        $conn->query("UPDATE rotasEstacoes SET ordem = $i WHERE idRota = $idRota AND ordem = $temp");
        $i++;
    }
}

$conn->begin_transaction();
try {
    if ($ordem > 0) {
        $conn->query("DELETE FROM rotasEstacoes WHERE idRota = $idRota AND ordem = $ordem");
    } elseif ($idEstacao > 0) {
        $conn->query("DELETE FROM rotasEstacoes WHERE idRota = $idRota AND idEstacao = $idEstacao");
    } else {
        throw new Exception('Nenhum identificador válido fornecido.');
    }

    renumerarOrdens($conn, $idRota);

    $conn->commit();
    $_SESSION['rota_msg'] = 'Estação removida com sucesso.';
} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['rota_msg'] = 'Erro ao remover estação: ' . $e->getMessage();
}

header("Location: editarRotas.php?id=$idRota");
exit;
