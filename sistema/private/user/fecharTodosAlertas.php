<?php
session_start();
include '../authGuard/authUsuario.php';
include '../conexao/conexao.php';
$idUser = $_SESSION['user_id'];

        $stmt = $conn->prepare("DELETE FROM alertas WHERE idFuncionario = ?");
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        header("Location: alertas.php");

        
?>