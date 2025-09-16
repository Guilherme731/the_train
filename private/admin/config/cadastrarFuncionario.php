<?php

include '../conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $tipo = $_POST['tipo'];


    $sql = " INSERT INTO usuarios (nome,email,senha,cpf,cargo,tipo) VALUE ('$name','$email','$senha', '$cpf', '$cargo', 'funcionario')";

    if ($conn->query($sql) === true) {
        echo "Novo jogador registrado criado com sucesso.";
    } else {
        echo "Erro " . $sql . '<br>' . $conn->error;
    }
    $conn->close();
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
    <title>Cadastrar Funcionário</title>
</head>

<body>
    <header class="headerAzulVoltar">
        <img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
    </header>

    <main class="mainCentral">
        <div>
            <h1 class="tituloAzul">Cadastrar Funcionário</h1>
            <form id="validarCadastroFuncionario">
                <div id="quadradoMenu">
                    <label for="nome">Nome</label>
                    <input type="text" id="nomeFuncionario" name="nome">
                    <div class="error" id="errorNome"></div>
                    <label for="email">Email</label>
                    <input type="text" id="emailFuncionario" name="email">
                    <div class="error" id="errorEmail"></div>
                    <label for="senha">Senha</label>
                    <input type="password" id="senhaFuncionario" name="senha">
                    <div class="error" id="errorSenha"></div>
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpfFuncionario" name="cpf">
                    <div class="error" id="errorCpf"></div>
                </div>
                <div class="flexCentro">
                    <button id="botaoSubmit" type="submit">
                        <div class="flexCentro">
                            <img class="iconeCadastrarFuncionarioTamanho"
                                src="../../../assets/icons/config/cadastroFuncionarioIcone.png">
                            <h2 id="textoCadastrar">Cadastrar</h2>
                        </div>
    
                    </button>

                </div>
            </form>




        </div></a>

        </div>

    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>

    <script src="../../../scripts/perfil/cadastrarFuncionario.js"></script>
</body>

</html>