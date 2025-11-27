<?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';

$id = $_SESSION['user_id'];

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aplicar']) && isset($_FILES["fotoPerfil"])){
    $target_dir = "../uploads/";
    $imageFileType = strtolower(pathinfo($_FILES["fotoPerfil"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . 'perfilUsuario' . $id . '.' . $imageFileType;
    $uploadOk = 1;

    $check = getimagesize($_FILES["fotoPerfil"]["tmp_name"]);
    if ($check !== false){
        $uploadOK = 1;
    }else{
        echo "<div class='mensagemErro'> 
            <p>O arquivo precisa ser uma imagem.</p>
            <a href='' class='fechar'>Fechar</a>
                </div>";
        $uploadOK = 0;
    }

    if($_FILES["fotoPerfil"]["size"] > 500000){
        echo "<div class='mensagemErro'> 
            <p>A imagem é muito grande. O máximo é 500kB.</p>
            <a href='' class='fechar'>Fechar</a>
                </div>";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
        echo(" <div class='mensagemErro'> 
            <p>A imagem precisa ter uma das seguintes extensões: .jpg .png .jpeg</p>
            <a href='' class='fechar'>Fechar</a>
                </div> ");
        $uploadOk = 0;
    }

    if ($uploadOk != 0){
        if(move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $target_file)){
            $imageFileName = 'perfilUsuario' . $id . '.' . $imageFileType;
            $sql = "UPDATE usuarios SET imagemPerfil = '$imageFileName' WHERE id=$id";
            $conn->query($sql);
            header("Location: editaPerfilFuncionario.php");

        }else{
            echo "<div class='mensagemErro'> 
            <p>Erro ao enviar arquivo.</p>
            <a href='' class='fechar'>Fechar</a>
                </div>";
        }
    }


}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['retirar'])){
    $sql = "UPDATE usuarios SET imagemPerfil = null WHERE id=$id";
    $conn->query($sql);
    header("Location: editaPerfilFuncionario.php");
}
    
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../style/style.css">
    <script src="../../../scripts/botoesMenus.js"></script>
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Editar Foto - The Train</title>
</head>

<body>
    <header class="headerAzulVoltar">
        <a href="editaPerfilFuncionario.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main class="quadradoAzul">
        <div class="gridCentro">
            <div class="gridCentro">
                    <div class="amarelo">
                        <h1 class="textoCentral">Foto de Perfil</h1>
                    </div>
            </div>

            <form action="" method="post" enctype="multipart/form-data" class="textoCentral">
                <div class="gridCentro">
                    <input type="file" name="fotoPerfil" required><br>
                    <button type="submit" name="aplicar" class="trocarFoto">
                        <p class="textoCentral">Aplicar nova foto</p>
                    </button>
                </div>
                
                
            </form>
            <form action="" method="post">
                <div class="gridCentro">
                <button type="submit" name="retirar" class="trocarFoto">
                    <p class="textoCentral">Retirar Foto</p>
                </button>
                </div>
            </form>
            <span id="textoAlerta">Ao aplicar uma nova foto, você concorda que a imagem será enviada para o servidor.</span>

        </div>

        


    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
    
    <script src="../../../scripts/perfil/trocarFoto.js"></script>
</body>

</html>