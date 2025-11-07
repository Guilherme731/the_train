<?php
session_start();
include '../../authGuard/authAdmin.php';
include '../../conexao/conexao.php';
$idUser = $_SESSION['user_id'];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
        $stmt = $conn->prepare("DELETE FROM mensagens WHERE id_destinatario = $id and id = ?");
        $stmt->bind_param("ii", $idUser, $id);
        $stmt->execute();
        header("Location: verMensagens.php");
    
}else{
    header("Location: verMensagens.php");
}
        
?>