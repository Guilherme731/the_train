<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Excluir Funcionario</title>
</head>
<body>
    <h2>Excluir Funcionario</h2>
    <p>Deseja Realmente Excluir o Funcionario?</p>
    <form action="" method="post">
        <button type="submit">Excluir</button>
    </form>
    <a href="editarPerfilUsuario.php">Voltar</a>
    
</body>
</html>
    <?php
        include '../conexao/conexao.php';

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                header("Location: editarPerfilUsuario.php");
            }
        }else{
            header("Location: editarPerfilUsuario.php");
        }
        
    ?>