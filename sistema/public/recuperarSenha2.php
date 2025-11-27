<?php
session_start();
include '../private/conexao/conexao.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_GET['email'] ?? "";
    $rawSenha = $_POST['novaSenha'] ?? "";
    $novaSenha = password_hash($rawSenha, PASSWORD_DEFAULT);
    $confirmarSenha = $_POST['confirmarSenha'] ?? "";
    $regexSenha = '/^(?=(?:.*[A-Za-z]){5,})(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/';


    if(strlen($rawSenha) < 8 || !preg_match($regexSenha, $rawSenha)){
        echo "<div class='mensagemCodigo'>
        <p>A senha deve conter no mínimo 8 caracteres, 5 letras, 1 letra maíuscula, 1 caractere especial e número</p>
        <a href='recuperarSenha2.php' class='fechar'>Fechar</a>
        </div>"; 
    } else if($rawSenha != $confirmarSenha){
        echo "<div class='mensagemCodigo'> 
        <p>A nova senha e a sua confirmação devem ser iguais.</p>
        <a href='' class='fechar'>Fechar</a>
        </div>";
    } else{
        $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
        $senhaHash = password_hash($rawSenha, PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $senhaHash, $email);
        $stmt->execute();
        echo "<div class='mensagemCodigo'> 
        <p>A sua senha foi alterada com sucesso!</p>
        <a href='login.php' class='fechar'>Voltar a página inicial</a>
        </div>";
    }
}
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../style/style.css">
    <title>Recuperar senha</title>
</head>
<body>
    <header class="headerAzulLogo">
        <img id="ajusteImagem" src="../assets/logos/logoPequena.png" alt="Logo Pequena">
    </header>
    <a href="../private/admin/config/configAdmin.php">
        <img src="../assets/icons/header/setaEsquerdaClara.PNG" alt="Seta" onclick="voltarPagina()">
    </a>
    <div class="tituloAzulEscuro">
        <h1>Recuperar senha</h1>
        <br>
    </div>
    <main class="gridCentro">
        <form action="" method="POST" autocomplete="off" id="formularioRecuperarSenha" class="gridCentro">
            <input type="password" name="novaSenha" id="novaSenha" class="inputTextPadrao" placeholder="Nova Senha" required value="<?php echo isset($_POST['novaSenha']) ? htmlspecialchars($_POST['novaSenha']) : '' ?>"></input>
            <input type="password" name="confirmarSenha" id="confirmarSenha" class="inputTextPadrao" placeholder="Confirmar Senha" required></input>
            <div id="aDireita">
                <input type="submit" id="botaoAlterarSenha" value="Alterar Senha">
            </div>
        </form>
    </main>
    <div class="espacoFooterAzul"></div>
    <footer class="footerAzulArredondado">
    </footer>
</body>
</html>