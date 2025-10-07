<?php
session_start();
include '../../authGuard/authUsuario.php';
include '../../conexao/conexao.php';

$id = $_SESSION['user_id'];

$sql = "SELECT imagemPerfil FROM usuarios WHERE id=$id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();

$imgFileName = $row['imagemPerfil'];
if(!isset($imgFileName)){
    $imgFileName = 'default.jpg';
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES["fotoPerfil"])){
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["fotoPerfil"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fotoPerfil"]["tmp_name"]);
    if ($check !== false){
        $uploadOK = 1;
    }else{
        echo "O arquivo não é uma imagem.";
        $uploadOK = 0;
    }

    if($_FILES["fotoPerfil"]["size"] > 500000){
        echo " Imagem muito pesada para o sistema. ";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
        echo(" Desculpe, só aceitamos JPG, JPEG e PNG. ");
        $uploadOk = 0;
    }

    if ($uploadOk == 0){
        echo "Desculpe seu arquivo não foi enviado.";
    }else{
        if(move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $target_file)){
            $imageFileName = basename($_FILES['fotoPerfil']["name"]);
            $sql = "UPDATE usuarios SET imagemPerfil = '$imageFileName' WHERE id=$id";
            $conn->query($sql);
            header("Location: editaPerfilFuncionario.php");

        }else{
            echo "Desculpa houve algum erro no envio.";
        }
    }


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
        <img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
    </header>

    <main>
        <div class="gridCentro">
            <div class="gridCentro">
                <h1 class="textoCentral">Foto de Perfil</h1>

                <img id="icone" src="../uploads/<?=$imgFileName?>" alt="Icone do funcionario">
            </div>

            <form action="" method="post" enctype="multipart/form-data" class="textoCentral">
                <input type="file" name="fotoPerfil"  required><br>
                <button type="submit" id="trocarFoto">
                    <p class="textoCentral">Aplicar nova foto</p>
                </button>
            </form>
            <span>Ao aplicar uma nova foto, você concorda que a imagem será enviada para o servidor.</span>

        </div>

        


    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
    
    <script src="../../../scripts/perfil/trocarFoto.js"></script>
</body>

</html>