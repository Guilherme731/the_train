<?php
session_start();
include '../../authGuard/authUsuario.php';

include '../../conexao/conexao.php';

$id = $_SESSION['user_id'];

$sql = "SELECT dataNascimento,genero,nome,imagemPerfil FROM usuarios WHERE id=$id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();

$result = $conn->query($sql);

$imgFileName = $row['imagemPerfil'];
if(!isset($imgFileName)){
    $imgFileName = 'default.png';
}

$dia = date('d', strtotime($row['dataNascimento']));
$mes = date('m', strtotime($row['dataNascimento']));
$ano = date('Y', strtotime($row['dataNascimento']));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $dia = $_POST['dataNascimentoDia'];
    $mes = $_POST['dataNascimentoMes'];
    $ano = $_POST['dataNascimentoAno'];
    $genero = $_POST['genero'];




    $sql = "UPDATE usuarios SET genero='$genero', dataNascimento='$ano-$mes-$dia' WHERE id=$id";

        if ($conn->query($sql) === true) {
            echo "<div class='mensagemErro'> 
            <p>Alteração salva com sucesso.</p>
            <a href='editaPerfilFuncionario.php' class='fechar'>Fechar</a>
                </div>";
        } else {
            echo "<div class='mensagemErro'> 
            <p>Erro</p>
            <a href='editaPerfilFuncionario.php' class='fechar'>Fechar</a>
                </div>" . $sql . '<br>' . $conn->error;
        }
    
}


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../style/style.css">
    <script src="../../../scripts/botoesMenus.js"></script>
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Editar Perfil</title>
</head>

<body>
    <header class="headerAzulVoltar">
        <a href="<?php if($_SESSION['tipo'] == 'admin'){echo '../../admin/config/configAdmin.php';} else {echo 'configFuncionario.php';}?>"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main>
        <div class="gridCentro">
            <div class="gridCentro">
                <h1 class="textoCentral">Editar Perfil</h1>

                <img id="icone" src="../uploads/<?=$imgFileName?>" alt="Icone do funcionario">
            </div>
            

            <h2 class="textoCentral"> <?php echo $row['nome']; ?> </h2>

        </div>

        <div class="gridCentro">


            <form  id="formularioConfgUsuario" method="POST" action="">

                <div id="informacoesPessoais">
                    <div class="flexCentro">
                        <a href="mudarFotoPerfil.php" style="text-decoration: none;" class="botaoSimples">Trocar Foto</a>
                    </div>
                    <br>
                    <div class="flexCentro">
                        <a href="mudarSenha.php" style="text-decoration: none;" class="botaoSimples">Mudar a Senha</a>
                    </div>

                    <p>Data de Nascimento:</p>

                    <div class="flex">
                        <div>
                            <label for="dataNascimentoDia"></label>
                            <input type="text" name="dataNascimentoDia" id="dataNascimentoDia" placeholder="Dia" value="<?php echo $dia; ?>">
                            <div class="error" id="errorDia"></div>
                        </div>

                        <div>
                            <label for="dataNascimentoMes"></label>
                            <input type="text" name="dataNascimentoMes" id="dataNascimentoMes" placeholder="Mês" value="<?php echo $mes; ?>">
                            <div class="error" id="errorMes"></div>
                        </div>

                        <div>
                            <label for="dataNascimentoAno"></label>
                            <input type="text" name="dataNascimentoAno" id="dataNascimentoAno" placeholder="Ano" value="<?php echo $ano; ?>">
                            <div class="error" id="errorAno"></div>
                        </div>

                    </div>
                    <br>

                    <label>
                        <select name="genero" id="generoFuncionario">
                            <option value="<?php echo $row['genero'];?>" selected><?php echo $row['genero'];?></option>
                            <option value="Feminino">Feminino</option>
                            <option value="Prefiro Não Dizer">Prefiro Não Dizer</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </label>
                    <div class="error" id="errorGenero"></div>


                </div>

                <button id="botaoSalvar" type="submit">
                    <h2 class="marginTop-10">Salvar</h2>
                </button>


            </form>







        </div>


    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
    
    <script src="../../../scripts/perfil/trocarFoto.js"></script>
</body>

</html>