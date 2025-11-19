<?php
session_start();
include '../../authGuard/authUsuario.php';

include '../../conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_SESSION['user_id'];
    $rawSenha = $_POST['novaSenha'] ?? "";
    $novaSenha = password_hash($rawSenha, PASSWORD_DEFAULT);
    $regexSenha = '/^(?=(?:.*[A-Za-z]){5,})(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/';
    $usuarioAtual = ($conn->query("SELECT senha FROM usuarios WHERE id = $id LIMIT 1"))->fetch_assoc();
    if(password_verify($_POST['senhaAntiga'], $usuarioAtual['senha'])){
        if(strlen($rawSenha) < 8 || !preg_match($regexSenha, $rawSenha)){
            echo "<div class='mensagemCodigo'>
        <p>A senha deve conter no mínimo 8 caracteres, 5 letras, 1 letra maíuscula, 1 caractere especial e número</p>
        <a href='mudarSenha.php' class='fechar'>Fechar</a>
        </div>"; 
        } else{
        $stmt = $conn->prepare("UPDATE usuarios SET senha=? WHERE id = ?");
        $stmt->bind_param("si", password_hash($rawSenha, PASSWORD_DEFAULT), $id);
        $stmt->execute();
        echo "<div class='mensagemCodigo'>
        <p>A sua senha foi alterada com sucesso!</p>
        <a href='../dashboard/dashboard.php' class='fechar'>Voltar para o dashboard</a>
        </div>"; 
        }
    }else{
        echo "<div class='mensagemErro'> 
            <p>Senha atual incorreta.</p>
            <a href='' class='fechar'>Fechar</a>
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
        <a href="../config/configFuncionario.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main class="mainCentral">
        <div>
            <h1 class="tituloAzul">Mudar a senha</h1>
            <div id="quadradoMenu" style="padding: 10px 7px;">
    
                <form action="" method="post">
                    <label for="senhaAntiga">Senha Antiga:</label><br>
                    <input type="password" class="campoSenhaMudar placeholderClaro" name="senhaAntiga" id="senhaAntiga" placeholder="****" required>
                    <br>
                    <label for="novaSenha">Senha Nova:</label><br>
                    <input type="password" class="campoSenhaMudar placeholderClaro" name="novaSenha" id="novaSenha" placeholder="****" required value="<?php echo isset($_POST['novaSenha']) ? htmlspecialchars($_POST['novaSenha']) : '' ?>">
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