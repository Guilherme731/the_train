<?php
session_start();
include '../../authGuard/authAdmin.php';

include '../../conexao/conexao.php';

$id = $_GET ['id'];

$sql = "SELECT * FROM usuarios WHERE id=$id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();

$imgFileName = $row['imagemPerfil'];
if(!isset($imgFileName)){
    $imgFileName = 'default.png';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    if($_POST['senha'] === ''){
        $senha = $row['senha'];
    }else{
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    }
    
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $salario = $_POST['salario'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $sql = "UPDATE usuarios SET nome = '$nome',email = '$email',senha = '$senha',cpf = '$cpf', cargo = '$cargo',salario = '$salario', cep = '$cep', rua = '$rua', numero = '$numero', cidade = '$cidade', estado = '$estado' WHERE id=$id";

    if ($conn->query($sql) === true) {
        header("location: selecionarUsuario.php");
    } else {
        echo "<div class='mensagemErro'> 
       <p>Novo Funcionario registrado com sucesso.</p>
       <a href='cadastrarFuncionario.php' class='fechar'>Fechar</a>
        </div>" . $sql . '<br>' . $conn->error;
    }
    $conn->close();
    exit(); 
}



?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../style/style.css">
    <script src="../../../scripts/botoesMenus.js"></script>
    <title>Editar Perfil De Usuário</title>
</head>

<body>
    <header class="headerAzulVoltar">
        <a href="selecionarUsuario.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main>
        <div class="gridCentro">

            <h2 class="tituloAzul">Editar Perfil De Usuário</h2>

            <img id="imagemUsuario" src="../../user/uploads/<?=$imgFileName?>" alt="Icone do funcionario">


            <h3 class="textoCentral"><?php echo $row['nome']?></h3>
        </div>

        <form action="" method="POST" id="formularioEditarPerfilUsuario">
        <div id="centroPerfil">
            <div class="flexCentro">
                <div id="informacoesEspeciaisUser">
                    <div class="marginTopDown-2">
                      <input type="text" name="cargo" id="cargo" value="<?php echo $row['cargo'] ?>" class="informacoesEspeciais" placeholder="Cargo"><br>
                      <div class="error" id="erroCargo"></div>
                    </div>
                      
                    <div class="marginTopDown-2">
                      <input type="text" name="cpf" id="cpf" value="<?php echo $row['cpf'] ?>" class="informacoesEspeciais" placeholder="CPF"><br>
                      <div class="error" id="erroCPF"></div>
                    </div>
                      
                  <div class="marginTopDown-2">
                      <input type="text" name="email" id="email" value="<?php echo $row['email'] ?>" class="informacoesEspeciais" placeholder="E-mail"><br>
                      <div class="error" id="erroEmail"></div>
                  </div>
      
                  <div class="marginTopDown-2">
                      <input type="text" name="nome" id="nomeUsuario" value="<?php echo $row['nome'] ?>" class="informacoesEspeciais" placeholder="Nome de Usuário">
                      <div class="error" id="erroNomeUsuario"></div>
                  </div>

                  <div class="marginTopDown-2">
                      <input type="text" name="senha" id="senhaUsuario" value="" class="informacoesEspeciais" placeholder="Senha">
                      <div class="error" id="erroSenha"></div>
                  </div>

                  <div class="marginTopDown-2">
                      <input type="text" name="salario" id="salarioUsuario" value="<?php echo $row['salario'] ?>" class="informacoesEspeciais" placeholder="Salário">
                      <div class="error" id="erroSalario"></div>
                  </div>

                  <div class="marginTopDown-2">
                      <input type="text" name="cep" id="cepUsuario" value="<?php echo $row['cep'] ?>" class="informacoesEspeciais" placeholder="CEP">
                      <div class="error" id="erroCep"></div>
                  </div>

                  <div class="marginTopDown-2">
                      <input type="text" name="rua" id="ruaUsuario" value="<?php echo $row['rua'] ?>" class="informacoesEspeciais" placeholder="Rua">
                      <div class="error" id="erroRua"></div>
                  </div>

                  <div class="marginTopDown-2">
                      <input type="text" name="numero" id="numeroUsuario" value="<?php echo $row['numero'] ?>" class="informacoesEspeciais" placeholder="Número">
                      <div class="error" id="erroNumero"></div>
                  </div>
      
                   <div class="marginTopDown-2">
                      <input type="text" name="cidade" id="cidadeUsuario" value="<?php echo $row['cidade'] ?>" class="informacoesEspeciais" placeholder="Cidade">
                      <div class="error" id="erroCidade"></div>
                  </div>
      
                   <div class="marginTopDown-2">
                      <input type="text" name="estado" id="estadoUsuario" value="<?php echo $row['estado'] ?>" class="informacoesEspeciais" placeholder="Estado">
                      <div class="error" id="erroEstado"></div>
                  </div>
      
                  </div>
              </div>
            </div>
        
            <div class="flex">
                    <input type="submit" id="botaoSalvarEditarPerfil" value="Salvar">
            </div>
            
    </form>    
    </main>
    <div class="espacoFooterAzulLogo"></div>
    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
    
</body>

</html>