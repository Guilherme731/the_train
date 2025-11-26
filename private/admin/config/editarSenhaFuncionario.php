<?php
session_start();
include '../../authGuard/authAdmin.php';

include '../../conexao/conexao.php';
$id = $_GET['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_GET['user_id'];
    $rawSenha = $_POST['novaSenha'] ?? "";
    $novaSenha = password_hash($rawSenha, PASSWORD_DEFAULT);
    $regexSenha = '/^(?=(?:.*[A-Za-z]){5,})(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/';
    $usuarioAtual = ($conn->query("SELECT senha FROM usuarios WHERE id = $id LIMIT 1"))->fetch_assoc();
    
        if(strlen($rawSenha) < 8 || !preg_match($regexSenha, $rawSenha)){
            echo "<div class='mensagemCodigo'>
        <p>A senha deve conter no mínimo 8 caracteres, 5 letras, 1 letra maíuscula, 1 caractere especial e número</p>
        <a href='editarSenhaFuncionario.php?user_id=$id' class='fechar'>Fechar</a>
        </div>"; 
        } else{
        $stmt = $conn->prepare("UPDATE usuarios SET senha=? WHERE id = ?");
        $stmt->bind_param("si", $novaSenha, $id);
        $stmt->execute();
        echo "<div class='mensagemCodigo'>
        <p>A senha do usuário foi alterada com sucesso!</p>
        <a href='editarPerfilUsuario.php?id=$id' class='fechar'>Voltar para a edição.</a>
        </div>"; 
        }
    
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Configurações</title>
    <script src="../../../scripts/botoesMenus.js"></script>
    <link rel="stylesheet" href="../../../style/style.css">
</head>

<body>
    <header class="headerAzulVoltar">
        <a href="editarPerfilUsuario.php?id=<?=$id?>"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main class="mainCentral">
        <div>
            <h1 class="tituloAzul">Mudar a senha</h1>
            <div id="quadradoMenu" style="padding: 10px 7px;">
    
                <form action="" method="post">
                    <label for="novaSenha">Senha Nova:</label><br>
                    <input type="password" class="campoSenhaMudar placeholderClaro" name="novaSenha" id="novaSenha" placeholder="****" required value="<?php echo isset($_POST['novaSenha']) ? htmlspecialchars($_POST['novaSenha']) : '' ?>">
                    <span>Atenção: Essa ação é irreversível!</span>
                    <input type="submit" class="botaoSimples" value="Confirmar Mudança">
                </form>
            </div>
        </div>
    
    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>

</html>