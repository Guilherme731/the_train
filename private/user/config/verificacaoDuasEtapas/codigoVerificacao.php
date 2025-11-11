<?php
session_start();
include '../../../authGuard/authUsuario.php';
include '../../../conexao/conexao.php';
$id = $_SESSION['user_id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $temFTA = $_POST["temFTA"] ?? "";
    $boolean = 1;
    if('numero1' == $codigo && 'numero2' == $codigo2 && 'numero3' == $codigo3 && 'numero4' == $codigo4 && 'numero5' == $codigo5 && 'numero6' == $codigo6){
        $stmt = $conn->prepare("UPDATE usuarios SET temTFA=? WHERE id=?");
        $stmt->bind_param("ii", $boolean, $id);
        $stmt->execute();
        $stmt->close();
    }else{
        echo "<div class='mensagemErro'> 
        <p>Código incorreto.</p>
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
    <link rel="shortcut icon" href="../../../../assets/logos/logoPequena.png">
    <script src="../../../../scripts/botoesMenus.js"></script>
    <script src="../../../../scripts/configFuncionarioSalvarInformacoes.js"></script>

    <link rel="stylesheet" href="../../../../style/style.css">

    <title>Verificação de duas etapas</title>
</head>
<body>
    <header class="headerAzulVoltar">
        <a href="../../config/configFuncionario.php">
            <img src="../../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
        </a>
    </header>

    <main>
    <div class="flexCentral textoCentral marginTop-100">
        <img id="iconeVerificacao2Etapas" src="../../../../assets/icons/config/verificacaoDuasEtapas/verificacao2EtapasIconeLaranja.png" alt="Icone de verificação de 2 etapas Laranja">
    </div>

    <div class="flexCentro">
        <form action="" method="POST">
        <input name="numero1" class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required> 

        <input name="numero2" class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required>
    
        <input name="numero3" class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required>
    
        <input name="numero4" class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required>
    
        <input name="numero5" class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required>
    
        <input name="numero6" class="campoNumeroVerificacao2Etapas" type="number" max="9" min="0" required>

        <br>
        <br>

        <button type="submit" class="botaoEnviar">Ativar verificação</button>
        </form>
    </div>
       

    <p id="textoVerificacao2EtapasConfirmacao">Um código de verificação foi enviado para o seu email. Insira o código para continuar.</p>
    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
</body>
</html>