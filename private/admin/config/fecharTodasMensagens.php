<?php
session_start();
include '../../authGuard/authAdmin.php';
include '../../conexao/conexao.php';
$idUser = $_SESSION['user_id'];

        $stmt = $conn->prepare("DELETE FROM mensagens WHERE id_destinatario = ?");
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        header("Location: verMensagens.php");

        
?>