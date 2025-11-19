<?php
include '../../conexao/conexao.php';
$idRota = $_GET['idRota'];
$idEstacao = $_GET['idEstacao'];
$ordemAtual = $_GET['ordemAtual'];
$operacao = $_GET['operacao'];

$sqlRotas = "SELECT idRota, idEstacao, ordem FROM rotasEstacoes WHERE idRota = $idRota AND idEstacao = $idEstacao AND ordem = $ordemAtual";
$resultRotas = $conn->query($sqlRotas);



if($operacao == 'subir'){
    $novaOrdem = $ordemAtual - 1;
    $sqlRotasAntigo = "SELECT idRota, idEstacao, ordem FROM rotasEstacoes WHERE idRota = $idRota AND ordem = $novaOrdem";
    $resultRotasAntigo = $conn->query($sqlRotasAntigo);
    $antigaEsta = $resultRotasAntigo->fetch_assoc();
    $antigaEst = $antigaEsta['idEstacao'];
    $sqlNovo = "UPDATE rotasEstacoes SET idEstacao = $antigaEst WHERE idRota = $idRota AND idEstacao = $idEstacao AND ordem = $ordemAtual";
    $sqlNovo2 = "UPDATE rotasEstacoes SET idEstacao = $idEstacao WHERE idRota = $idRota AND ordem = $novaOrdem";
$conn->query($sqlNovo);
$conn->query($sqlNovo2);
header("Location: editarRotas.php?id=$idRota");
}
if($operacao == 'descer'){
    $novaOrdem = $ordemAtual + 1;
    $sqlRotasAntigo = "SELECT idRota, idEstacao, ordem FROM rotasEstacoes WHERE idRota = $idRota AND ordem = $novaOrdem";
    $resultRotasAntigo = $conn->query($sqlRotasAntigo);
    $antigaEst = ($resultRotasAntigo->fetch_assoc())['idEstacao'];
    $sqlNovo = "UPDATE rotasEstacoes SET idEstacao = $antigaEst WHERE idRota = $idRota AND idEstacao = $idEstacao AND ordem = $ordemAtual";
    $sqlNovo2 = "UPDATE rotasEstacoes SET idEstacao = $idEstacao WHERE idRota = $idRota AND ordem = $novaOrdem";
    $conn->query($sqlNovo);
$conn->query($sqlNovo2);
header("Location: editarRotas.php?id=$idRota");
}
if($operacao == 'excluir'){
    $sqlNovo = "DELETE FROM rotasEstacoes WHERE idRota = $idRota AND ordem = $ordemAtual";
    $conn->query($sqlNovo);
    header("Location: editarRotas.php?id=$idRota");
}


?>