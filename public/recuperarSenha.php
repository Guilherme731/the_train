<?php
session_start();
include '../private/conexao/conexao.php';

$erroEmail = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $regexEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    if (empty($email)) {
        $erroEmail = "Preencha o campo de email.";
    } elseif (!preg_match($regexEmail, $email)) {
        $erroEmail = "Digite um email válido.";
    } else {
        $sql = "SELECT email FROM usuarios WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("Location: recuperarSenha2.php");
            exit;
        } else {
            $erroEmail = "Email não cadastrado.";
        }
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
        <form action="" method="POST" autocomplete="off">
            <input type="text" name="email" id="email" class="inputTextPadrao" placeholder="Digite seu email" required value="<?php echo htmlspecialchars($email); ?>">
            <?php if ($erroEmail): ?>
                <div class="mensagemErroInput"><?php echo $erroEmail; ?></div>
            <?php endif; ?>
            <div id="aDireita">
                <input type="submit" id="botaoSalvar" value="Próxima">
            </div>
        </form>
    </main>
    <div class="espacoFooterAzul"></div>
    <footer class="footerAzulArredondado">
    </footer>
</body>
</html>