<?php
session_start();
include '../private/conexao/conexao.php';

$erroSenha = "";
$novaSenha = "";
$confirmacaoSenha = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_SESSION['user_id'] ?? null;
    $novaSenha = $_POST['novaSenha'] ?? "";
    $confirmacaoSenha = $_POST['confirmacaoSenha'] ?? "";

    if (empty($novaSenha) || empty($confirmacaoSenha)) {
        $erroSenha = "Preencha todos os campos.";
    } elseif (strlen($novaSenha) < 8) {
        $erroSenha = "A senha deve ter no mínimo 8 caracteres.";
    } elseif ($novaSenha !== $confirmacaoSenha) {
        $erroSenha = "As senhas não coincidem.";
    } elseif ($id) {
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET senha=? WHERE id = ?");
        $stmt->bind_param("si", $senhaHash, $id);
        $stmt->execute();
        $stmt->close();
        header('Location: ../index.php');
        exit;
    } else {
        $erroSenha = "Usuário não identificado.";
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
    <a href="../public/recuperarSenha.php">
        <img src="../assets/icons/header/setaEsquerdaClara.PNG" alt="Seta" onclick="voltarPagina()">
    </a>
    <div class="tituloAzulEscuro">
        <h1>Recuperar senha</h1>
        <br>
    </div>
    <main class="gridCentro">
        <form action="" id="formularioRecuperarSenha" class="gridCentro" method="POST" autocomplete="off">
            <input type="password" name="novaSenha" id="novaSenha" class="inputTextPadrao" placeholder="Nova senha" required value="<?php echo htmlspecialchars($novaSenha); ?>">
            <input type="password" name="confirmacaoSenha" id="confirmacaoSenha" class="inputTextPadrao" placeholder="Confirmar senha" required value="<?php echo htmlspecialchars($confirmacaoSenha); ?>">
            <?php if ($erroSenha): ?>
                <div class="mensagemErroInput"><?php echo $erroSenha; ?></div>
            <?php endif; ?>
            <div class="aDireita">
                <input id="botaoAlterarSenha" type="submit" value="Alterar Senha">
            </div>
        </form>
    </main>

    <div class="espacoFooterAzul"></div>
    <footer class="footerAzulArredondado">

    </footer>

    <script src="../scripts/login/novaSenha.js"></script>
</body>

</html>