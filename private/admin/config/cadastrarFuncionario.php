<?php

include '../../conexao/conexao.php';

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
                    <input type="text" id="nomeFuncionario" name="nome" placeholder="Nome">
                    <label class="error" id="errorNome"></label>
                    <input type="text" id="cargoFuncionario" name="cargo" placeholder="Cargo">
                    <div class="error" id="errorCargo"></div>
                    <input type="text" id="salarioFuncionario" name="salario" placeholder="Salario">
                    <div class="error" id="errorSalario"></div>
                    <input type="text" id="emailFuncionario" name="email" placeholder="Email">
                    <div class="error" id="errorEmail"></div>
                    <input type="password" id="senhaFuncionario" name="senha" placeholder="Senha">
                    <div class="error" id="errorSenha"></div>
                    <input type="text" id="cpfFuncionario" name="cpf" placeholder="CPF">
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