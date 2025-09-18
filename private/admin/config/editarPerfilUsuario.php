<?php

include '../../conexao/conexao.php';

$id = $_GET ['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $salario = $_POST['salario'];

    $sql = "UPDATE usuarios SET nome = '$nome',email = '$email',senha = '$senha',cpf = '$cpf', cargo = '$cargo',salario = '$salario' WHERE id=$id";

    if ($conn->query($sql) === true) {
        echo "Registro atualizado com sucesso.
        <a href=''>Ver registros.</a>
        ";
    } else {
        echo "Erro " . $sql . '<br>' . $conn->error;
    }
    $conn->close();
    exit(); 
}

$sql = "SELECT * FROM usuarios WHERE id=$id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();

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
        <img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
    </header>

    <main>
        <div class="gridCentro">

            <h2 class="tituloAzul">Editar Perfil De Usuário</h2>

            <img id="imagemUsuario" src="../../../assets/icons/config/funcionarioIcone.png" alt="Icone do funcionario">

            <h3 class="textoCentral">Nome do Usuário</h3>
        </div>

        <form id="formularioEditarPerfilUsuario">
        <div id="centroPerfil">
            <div class="flexCentro">
                <div id="informacoesEspeciaisUser">
                    <div class="marginTopDown-2">
                      <input type="text" name="cargo" id="cargo" class="informacoesEspeciais" placeholder="Cargo"><br>
                      <div class="error" id="erroCargo"></div>
                    </div>
                      
                    <div class="marginTopDown-2">
                      <input type="text" name="CPF" id="cpf" class="informacoesEspeciais" placeholder="CPF"><br>
                      <div class="error" id="erroCPF"></div>
                    </div>
                      
                  <div class="marginTopDown-2">
                      <input type="text" name="email" id="email" class="informacoesEspeciais" placeholder="E-mail"><br>
                      <div class="error" id="erroEmail"></div>
                  </div>
      
                  <div class="marginTopDown-2">
                      <input type="text" name="nomeUsuario" id="nomeUsuario" class="informacoesEspeciais" placeholder="Nome de Usuário">
                      <div class="error" id="erroNomeUsuario"></div>
                  </div>

                  <div class="marginTopDown-2">
                      <input type="text" name="senha" id="senhaUsuario" class="informacoesEspeciais" placeholder="Senha">
                      <div class="error" id="erroSenha"></div>
                  </div>

                  <div class="marginTopDown-2">
                      <input type="text" name="salario" id="salarioUsuario" class="informacoesEspeciais" placeholder="Salário">
                      <div class="error" id="erroSalario"></div>
                  </div>
      
                  </div>
              </div>
            </div>
        
            <div class="flex">
                <div id="espacoButton">
                    <a href="../../admin/config/deleteUser.php?id=<?=$id?>">
                        deletar
                    </a>
                </div>
                <div id="espacoButton">
                    <input type="submit" id="botaoSalvarEditarPerfil" value="Salvar">
                </div>
            </div>
            
    </form>    
    </main>
    <div class="espacoFooterAzulLogo"></div>
    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
    
</body>

</html>