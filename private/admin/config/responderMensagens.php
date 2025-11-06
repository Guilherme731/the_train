<?php
session_start();
include '../../authGuard/authAdmin.php';

include '../../conexao/conexao.php';

$sql = 'SELECT tipo, id_remetente, id_destinatario, conteudo, data_envio FROM mensagens';

if (mysqli_num_rows($result) > 0) {
    echo "<mensagens>";
    while ($linha = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $tipo["tipo"] . "</td>";
        echo "<td>" . $id_remetente["id_remetente"] . "</td>";
        echo "<td>" . $id_destinario["id_destinatario"] . "</td>";
        echo "<td>" . $conteudo["conteudo"] . "</td>";
        echo "<td>" . $data_envio["data_envio"] . "</td>";
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
</head>
<body>
    
</body>
</html>