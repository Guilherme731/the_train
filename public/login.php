<?php 
session_start();
include("../private/conexao/conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $pass = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT id, email, senha FROM usuarios WHERE email=? AND senha=?");
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados = $result->fetch_assoc();
    $stmt->close();

    if ($dados) {
        $_SESSION["user_id"] = $dados["id"];
        $_SESSION["email"] = $dados["email"];
        header("Location: ../private/user/dashboard/dashboard.php");
    } else {
        echo("Usuário ou senha incorretos!");
    }
}

if(isset($_SESSION["email"])){
    echo("Você já tem sessão iniciada com <br> " . $_SESSION["email"] . '<br> deseja <a href="sair.php">encerrar sessão</a>?');
    exit;
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
    <header class="headerAzulLogo">
        <img src="../assets/logos/logoPequena.png" alt="Logo Pequena">
    </header>
    <main>
        <p class="tituloLogin">LOGIN</p>
        <form id="formLogin" class="formularioLogin" method="POST" action="">
            <label for="email"></label>
            <input type="text" name="email" id="emailFuncionarioLogin" placeholder="E-mail">
            <label for="password"></label>
            <div class="error" id="errorEmailLogin"></div>
            <input type="password" name="password" id="senhaFuncionarioLogin" placeholder="Senha">
            <div class="error" id="errorSenhaLogin"></div>
            <a href="recuperarSenha.php">Esqueceu a senha?</a>
            <button type="submit">Entrar</button>
        </form>
    </main>
    <div class="espacoFooterAzul"></div>
    <footer class="footerAzulArredondado">

    </footer>

</body>
</html>