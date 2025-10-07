<?php
session_start();
include '../authGuard/authUsuario.php';
include '../conexao/conexao.php';
$idUser = $_SESSION['user_id'];

if(isset($_GET['idAlerta'])){
    $id = $_GET['idAlerta'];
    
        $stmt = $conn->prepare("DELETE FROM alertas WHERE idFuncionario = ? AND idNotificacao = ?");
        $stmt->bind_param("ii", $idUser, $id);
        $stmt->execute();
        header("Location: alertas.php");
    
}else{
    header("Location: alertas.php");
}
        
?>