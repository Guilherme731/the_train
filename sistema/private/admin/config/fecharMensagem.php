<?php
session_start();
include '../../authGuard/authAdmin.php';
include '../../conexao/conexao.php';
$idUser = $_SESSION['user_id'];

if(isset($_GET['ida'])){
    $id = $_GET['ida'];
    
    $stmt = $conn->prepare("DELETE FROM mensagens WHERE id = ? AND id_destinatario = ?");
    $stmt->bind_param("ii", $id, $idUser);
    $stmt->execute();
    $stmt->close();
    header("Location: verMensagens.php");
    exit();
}else{
    header("Location: verMensagens.php");
    exit();
}
?>