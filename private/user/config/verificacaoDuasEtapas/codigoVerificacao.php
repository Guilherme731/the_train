<?php
session_start();
include '../../../authGuard/authUsuario.php';
include '../../../conexao/conexao.php';
$id = $_SESSION['user_id'];

$numero1 = $_POST["numero1"] ?? "";
$numero2 = $_POST["numero2"] ?? "";
$numero3 = $_POST["numero3"] ?? "";
$numero4 = $_POST["numero4"] ?? "";
$numero5 = $_POST["numero5"] ?? "";
$numero6 = $_POST["numero6"] ?? "";

 $stmt = $conn->prepare('SELECT codigo_1, codigo_2, codigo_3, codigo_4, codigo_5, codigo_6 FROM codigos WHERE id = ? LIMIT 1');
    if (!$stmt) { echo 'Erro no prepare: ' . $conn->error; exit; }
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $res = $stmt->get_result();
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        $codigo_1 = intval($row['codigo_1']);
        $codigo_2 = intval($row['codigo_2']);
        $codigo_3 = intval($row['codigo_3']);
        $codigo_4 = intval($row['codigo_4']);
        $codigo_5 = intval($row['codigo_5']);
        $codigo_6 = intval($row['codigo_6']);
    }
    echo "<div class='mensagemCodigo'> 
        <p>O código enviado ao seu email é: $codigo_1 $codigo_2 $codigo_3 $codigo_4 $codigo_5 $codigo_6</p>
        <a href='' class='fechar'>Fechar</a>
        </div>";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['reenviar'])){

        $numero1 = rand(0, 9);
        $numero2 = rand(0, 9);
        $numero3 = rand(0, 9);
        $numero4 = rand(0, 9);
        $numero5 = rand(0, 9);
        $numero6 = rand(0, 9);

        $sql = "UPDATE codigos SET codigo_1=$numero1, codigo_2=$numero2, codigo_3=$numero3, codigo_4=$numero4, codigo_5=$numero5, codigo_6=$numero6 WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else if(isset($_POST['verificar'])){
    $temFTA = $_POST["temFTA"] ?? "";
    $boolean = 1;
    if($numero1 == $codigo_1 && $numero2 == $codigo_2 && $numero3 == $codigo_3 && $numero4 == $codigo_4 && $numero5 == $codigo_5 && $numero6 == $codigo_6){
        $stmt = $conn->prepare("UPDATE usuarios SET temTFA=? WHERE id=?");
        $stmt->bind_param("ii", $boolean, $id);
        $stmt->execute();
        $stmt->close();
        echo "<div class='mensagemCodigo'> 
        <p>Código de verificação de duas etapas aplicado com sucesso.</p>
        <a href='' class='fechar'>Fechar</a>
            </div>";
    
    }else{
        echo "<div class='mensagemErro'> 
        <p>Código incorreto.</p>
        <a href='' class='fechar'>Fechar</a>
            </div>";
    }
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

        <div class="flexCentro">
        <button type="submit" class="botaoEnviar" name="verificar">Ativar verificação</button>
        <button class="botaoEnviar" type="submit" name="reenviar">Reenviar código</button>
        </div>
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