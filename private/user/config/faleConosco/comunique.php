<?php
    session_start();
    include '../../../authGuard/authUsuario.php';
    include '../../../conexao/conexao.php'; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mensagem'])) {
        $mensagem = $_POST['mensagem'];
        $usuario_id = $_SESSION['id']; 
        $sql = "INSERT INTO mensagens (usuario_id, id_remetente, id_destinatario, conteudo, data_envio) VALUES (?, ?, )NOW)";
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
                
                <label for="tipo"></label>
                <select id="escolherTipo" name="tipo" id="tipo" required>
                    <option value="duvida">Dúvida</option>
                    <option value="reportarErro">Reportar Erro</option>
                    <option value="marcarAudiencia">Marcar Audiência</option>
                </select>

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