<?php
    session_start();
    include '../../authGuard/authUsuario.php';
    include '../../conexao/conexao.php'; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (isset($_SESSION['user_id'])) {
            $id_remetente = (int) $_SESSION['user_id'];
        } else {
            echo "Usuário não autenticado. Faça login.";
            exit;
        }

        $id_destinatario = null;
        $res = $conn->query("SELECT id FROM usuarios WHERE tipo = 'admin' LIMIT 1");
        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $id_destinatario = (int) $row['id'];
        } else {
            echo "Nenhum administrador encontrado.";
            exit;
        }

        $conteudo = isset($_POST['conteudo']) ? trim($_POST['conteudo']) : '';
        $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 'duvida';

        if ($conteudo === '') {
            echo "A mensagem não pode ficar vazia.";
            exit;
        }

        $data_envio = date('Y-m-d H:i:s');

        $sql = "INSERT INTO mensagens (id_remetente, id_destinatario, conteudo, tipo, data_envio) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo 'Erro no prepare: ' . $conn->error;
            exit;
        }

        $stmt->bind_param("iisss", $id_remetente, $id_destinatario, $conteudo, $tipo, $data_envio);
        if (!$stmt->execute()) {
            echo 'Erro ao executar query: ' . $stmt->error;
            exit;
        }

        echo "<div class='mensagemErro'>
        <p>Mensagem enviada com sucesso!</p>
        <a class='fechar' href='comunique.php'>Fechar</a>
        </div>";
    }
?>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../../scripts/botoesMenus.js"></script>
    <script src="../../../scripts/iconeEnviar.js"></script>
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../style/style.css">
    <title>Comunique</title>
</head>
<body>
    <header class="headerAzulVoltar">
        <img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
    </header>
    <main class="gridCentro">
        <div id="quadradoMenu">
            <div class="flexCentro textoCentral">
                <img class="iconeConfigTamanho" src="../../../assets/icons/config/faleConoscoIcone.png" alt="imagem do icone fale conosco">
                <h2>Comunique</h2>
            </div>

            <br>
            <div class="opcaoMenu padding-20">
                <form class="gridCentro" action="" method="POST">
                
                <label for="tipo"></label>
                <select id="escolherTipo" name="tipo" id="tipo" required>
                    <option value="duvida">Dúvida</option>
                    <option value="reportarErro">Reportar Erro</option>
                    <option value="marcarAudiencia">Marcar Audiência</option>
                </select>

                <textarea name="conteudo" id="caixaMensagem" required></textarea>
                <button id="botao" type="submit"><img class="iconeConfigTamanho" src="../../../assets/icons/config/EnviarIcone.PNG" alt="Imagem do icone enviar"></button>
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