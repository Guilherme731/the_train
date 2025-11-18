<?php
session_start();
include '../../authGuard/authAdmin.php';
include '../../conexao/conexao.php';
$idUser = $_SESSION['user_id'];

if(isset($_GET['ida'])){
    $id = $_GET['ida'];
    
    $stmt = $conn->prepare("DELETE FROM manutencoes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: criarManutencao.php");
    exit();
}else{
    header("Location: criarManutencao.php");
    exit();
}
?>