<?php

include '../../conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $genero = $_POST['genero'];
    $dataNascimento = $_POST['dataNascimento'];
    $salario = $_POST['salario'];
    $tipoFuncionario = $_POST['tipo'];

    $sql = " INSERT INTO usuarios (nome,email,senha,cpf,cargo,tipo,genero,dataNascimento,salario) VALUE ('$name','$email','$senha', '$cpf', '$cargo', '$tipoFuncionario', '$genero', '$dataNascimento', '$salario')";

    if ($conn->query($sql) === true) {
        echo "Novo Funcionario registrado com sucesso.";
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
        <a href="configAdmin.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main class="mainCentral">
        <div>
            <h1 class="tituloAzul">Cadastrar Funcionário</h1>
            <form id="validarCadastroFuncionario" method="POST">
                <div id="quadradoMenu">
                    <input type="text" id="nomeFuncionario" class="placeholderClaro" name="nome" placeholder="Nome">
                    <label class="error" id="errorNome"></label>

                    <label for="cargo" id="" class="placeholderClaro">
                        <select name="cargo" id="cargoFuncionario">
                            <option value="Administrador">Administrador</option>
                            <option value="Mecânico">Mecânico</option>
                            <option value="Faxineiro">Faxineiro</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Operário">Operário</option>
                            <option value="Piloto">Piloto</option> 
                        </select>
                    

                    <input type="text" id="salarioFuncionario" class="placeholderClaro" name="salario" placeholder="Salario">
                    <div class="error" id="errorSalario"></div>
                    <input type="text" id="emailFuncionario" class="placeholderClaro" name="email" placeholder="Email">
                    <div class="error" id="errorEmail"></div>
                    <input type="password" id="senhaFuncionario" class="placeholderClaro" name="senha" placeholder="Senha">
                    <div class="error" id="errorSenha"></div>
                    <input type="text" id="cpfFuncionario" class="placeholderClaro" name="cpf" placeholder="CPF">
                    <div class="error" id="errorCpf"></div>                    

                    <label for="genero">
                        <select name="genero" id="generoFuncionario">
                            <option value="Feminino">Feminino</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Prefiro não dizer">Prefiro não dizer</option>
                            <option value="Outro">Outro</option>
                        </select>
                    <div class="error" id="errorGenero"></div>

                    <input type="date" id="dataNascimentoFuncionario" name="dataNascimento" placeholder="Data de Nascimento">
                    <div class="error" id="errorDataNascimento"></div>

                    <label for="tipo" id="" name="" placeholder="Data de Nascimento">
                        <select name="tipo" id="tipoFuncionario">
                            <option value="funcionario">Funcionario</option>
                            <option value="admin">Admin</option>
                        </select>
                    <div class="error" id="errorDataNascimento"></div>
                </div>
                <div class="flexCentro">
                    <button id="botaoSubmit" type="submit">
                        <div class="flexCentro">
                            <img class="iconeCadastrarFuncionarioTamanho" src="../../../assets/icons/config/cadastroFuncionarioIcone.png">
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

</body>

</html>