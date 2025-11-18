<?php
include '../../../conexao/conexao.php';
if(isset($_GET['id'])){
$id=$_GET['id'];
 $stmt = $conn->prepare("UPDATE usuarios SET temTFA = 0 WHERE id = ?");
 $stmt->bind_param("i", $id);
 $stmt->execute();
 header("Location: ../../../admin/config/configAdmin.php");
}
?>