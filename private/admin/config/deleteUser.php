<?php
    include '../../conexao/conexao.php';

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                header("Location: selecionarUsuario.php");
            }
        }else{
            header("Location: selecionarUsuario.php");
        }
        
?>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../style/style.css">
    <title>Excluir Funcionário</title>
</head>
<body>

<header class="headerAzulVoltar">
    <a href="selecionarUsuario.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
</header>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="gridCentro">
    <div class="flexCentro">
        <h2>Excluir Funcionário</h2>
    </div>
    <div class="flexCentro">
        <h3>Deseja Realmente Excluir o Funcionário?</h3>
    </div>
         
    <form action="" method="post">
        <input class="quadradoAzulNormalPequeno" type="submit" value="Excluir">
    </form>
        
        


    <a href="selecionarUsuario.php" class="quadradoAzulNormalPequeno">
        <div>
            <p>Voltar</p>
        </div>
    </a>
    
</div>


<div class="flexCentro">
    <div class="espacoFooterAzulLogo"></div>
    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</div>

    
</body>
</html>
    <?php
        include '../../conexao/conexao.php';

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                header("Location configAdmin.php");
            }
        }else{
            header("Location configAdmin.php");
        }
        
    ?>