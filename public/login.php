<?php

$mysqli = new mysqli("localhost", "root", "root", "the_train_db");
if ($mysqli->connect_errno) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: public/login.php");
    exit;
}

$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $pass = $_POST["password"] ?? "";

    $stmt = $mysqli->prepare("SELECT id, email, senha FROM usuarios WHERE email=? AND senha=?");
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados = $result->fetch_assoc();
    $stmt->close();

    if ($dados) {
        $_SESSION["user_id"] = $dados["id"];
        $_SESSION["email"] = $dados["email"];
        header("Location: public/login.php");
        exit;
    } else {
        $msg = "Usuário ou senha incorretos!";
    }
}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../style/style.css">
    <title>Login - The Train</title>
</head>
<body>

<?php if (!empty($_SESSION["user_id"])): 
    header("Location: public/login.php");?>
    
  <div class="card">
    <h3>Bem-vindo, <?= $_SESSION["email"] ?>!</h3>
    <p>Sessão ativa.</p>
    <p><a href="?logout=1">Sair</a></p>
  </div>

    <header class="headerAzulLogo">
        <img src="../assets/logos/logoPequena.png" alt="Logo Pequena">
    </header>
    <main>
        <?php else: ?>
         <div class="card">   
        <p class="tituloLogin">LOGIN</p>
        <?php if ($msg): ?><p class="msg"><?= $msg ?></p><?php endif; ?>
        <form id="formLogin" class="formularioLogin">
            <label for="email"></label>
            <input type="text" name="email" id="emailFuncionarioLogin" placeholder="E-mail">
            <label for="senha"></label>
            <div class="error" id="errorEmailLogin"></div>
            <input type="password" name="senha" id="senhaFuncionarioLogin" placeholder="Senha">
            <div class="error" id="errorSenhaLogin"></div>
            <a href="recuperarSenha.html">Esqueceu a senha?</a>
            <button type="submit">Entrar</button>
        </form>
        </div>
    </main>
    <div class="espacoFooterAzul"></div>
    <footer class="footerAzulArredondado">

    </footer>
    <script src="../scripts/login/validarLogin.js"></script>

</body>
</html>