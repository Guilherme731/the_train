<?php
session_start();
include '../../authGuard/authAdmin.php';

include '../../conexao/conexao.php';
 
$sql = 'SELECT * FROM mensagens';
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (mysqli_num_rows($result) > 0) {
    echo "<mensagens>";
    while ($linha = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $linha["tipo"] . "</td>";
        echo "<td>" . $linha["conteudo"] . "</td>";
        echo "<td>" . $linha["data_envio"] . "</td>";
        echo "</tr>";
    }
    echo "</mensagens>";
} else {
    echo "Nenhum resultado encontrado.";
}


?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responder Mensagens</title>
    <link rel="stylesheet" href="../../../style/style.css">
</head>
<body>
    <label for="resposta"></label>
    <textarea placeholder="Resposta" id="caixaMensagem"></textarea>
    <button type="submit">Enviar resposta</button>
</body>
</html>