<?php 
session_start();
include("../private/conexao/conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $pass = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT id, email, senha, tipo, temTFA FROM usuarios WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados = $result->fetch_assoc();
    $stmt->close();

    if (password_verify($pass, $dados['senha'])) {
        $_SESSION["user_id"] = $dados["id"];
        $_SESSION["email"] = $dados["email"];
        $_SESSION["tipo"] = $dados["tipo"];
        $_SESSION["verificado"] = false; // ainda não passou pela verificação
        if($dados['temTFA'] == 1){
            header("Location: ../private/user/config/verificacaoDuasEtapas/codigoVerificacao.php");
        }else{
            header("Location: ../private/user/dashboard/dashboard.php");
        }
        
    } else {
        echo "<div class='mensagemErro'>
        <p>Nome ou senha incorretos</p>
        <a class='fechar' href='login.php'>Fechar</a>
        </div>";
    }
}

if(isset($_SESSION["email"]) && isset($_SESSION["verificado"]) && $_SESSION["verificado"] === true){
    header("Location: ../private/user/dashboard/dashboard.php");
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