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
        // Aqui você pode implementar o reenviar código
        echo "<div class='mensagemCodigo'> <p>Código reenviado para seu email.</p><a href='' class='fechar'>Fechar</a></div>";
    } elseif(isset($_POST['verificar'])) {
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

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../../style/style.css">
    <title>Verificação de 2 etapas</title>
</head>

<body>
    <header class="headerAzulLogo">
        <img id="ajusteImagem" src="../../../../assets/logos/logoPequena.png" alt="Logo Pequena">
    </header>
    <a href="../../../../public/recuperarSenha2.php">
        <img src="../../../../assets/icons/header/setaEsquerdaClara.PNG" alt="Seta" onclick="voltarPagina()">
    </a>
    <div class="tituloAzul">
        <h1>Verificação de 2 etapas</h1>
        <br>
    </div>
    <main>
        <br>
        <br>
        <br>
        <div class="container">
            <form method="POST" action="">
                <div class="grupoInputs">
                    <input type="number" name="numero1">
                    <input type="number" name="numero2">
                    <input type="number" name="numero3">
                    <input type="number" name="numero4">
                    <input type="number" name="numero5">
                    <input type="number" name="numero6">
                </div>
                <h2 class="tituloAzul">
                    Um código de verificação foi enviado para o seu email. Insira o código para continuar.
                </h2>
                
                <div class="flexCentro">
                    <button class="ativo" type="submit" name="reenviar">Reenviar código</button>
                    <button class="ativo" type="submit" name="verificar">Verificar</button>
                   
                </div>
                
            </form>
        </div>
    </main>
    <div class="espacoFooterAzul"></div>
    <footer class="footerAzulArredondado">

    </footer>
</body>

</html>