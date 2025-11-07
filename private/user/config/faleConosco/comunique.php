<?php
    session_start();
    include '../../../authGuard/authUsuario.php';
    include '../../../conexao/conexao.php'; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[''])) {
        $usuario_id = $_SESSION['usuario_id']; 
        $id_remetente = $_SESSION['id_remetente'];
        $id_destinatario = $_SESSION['id_destinatario'];
        $conteudo = $_SESSION['conteudo'];
        $tipo = $_SESSION['tipo'];
        $data_envio = $_SESSION['data_envio'];

        $sql = "INSERT INTO mensagens (usuario_id, id_remetente, id_destinatario, conteudo, tipo, data_envio) VALUES ($usuario_id, $id_remetente, $id_destinatario, $conteudo, $tipo, $data_envio)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $usuario_id, $mensagem);
        $stmt->execute();
   
    }
?>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../../../scripts/botoesMenus.js"></script>
    <script src="../../../../scripts/iconeEnviar.js"></script>
    <link rel="shortcut icon" href="../../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../../style/style.css">
    <title>Comunique</title>
</head>
<body>
    <header class="headerAzulVoltar">
        <img src="../../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
    </header>
    <main>
        <div id="quadradoMenu">
            <div class="flexCentro textoCentral">
                <img class="iconeConfigTamanho" src="../../../../assets/icons/config/faleConoscoIcone.png" alt="imagem do icone fale conosco">
                <h2>Comunique</h2>
            </div>

            <br>
            <div class="opcaoMenu padding-20">
                <form action="" method="POST">
                <textarea name="marcarAudiencia" id="caixaMensagem" required></textarea>
                <button id="botao" type="submit"><img class="iconeConfigTamanho" src="../../../../assets/icons/config/EnviarIcone.PNG" alt="Imagem do icone enviar"></button>
                </form>
               
            </div>
        </div>

    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>
</html>