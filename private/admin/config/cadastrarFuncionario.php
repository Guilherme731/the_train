<?php

include '../../conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $valido = false;

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

    if($valido == true){
        if ($conn->query($sql) === true) {
            echo "<div class='mensagemErro'> 
        <p>Novo Funcionario registrado com sucesso.</p>
        <a href='cadastrarFuncionario.php' class='fechar'>Fechar</a>
            </div>";
        } else {
            echo "<div class='mensagemErro'> 
        <p>Erro</p>
        <a href='cadastrarFuncionario.php' class='fechar'>Fechar</a>
            </div>" . $sql . '<br>' . $conn->error;
        }
        $conn->close();
    }


    
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
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if(!$name){
                                echo "<div class='error'>
                                <p>Preencha o Nome de Forma Correta</p>
                                </div>";
                                $valido = false;
                            }else{
                                $valido = true;
                            }
                        }
                        ?>   
                    <label class="error" id="errorNome"></label>

                    <label for="cargo" id="" class="placeholderClaro">
                        <select name="cargo" id="cargoFuncionario">
                            <option value="none">Cargo</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Mecânico">Mecânico</option>
                            <option value="Faxineiro">Faxineiro</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Operário">Operário</option>
                            <option value="Piloto">Piloto</option> 
                        </select>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if(!$cargo || $cargo == 'none'){
                                echo "<div class='error'>
                                <p>Preencha o Cargo de Forma Correta</p>
                                </div>";
                                $valido = false;
                            }else{
                                $valido = true;
                            }
                        }
                        ?>   
                    

                    <input type="text" id="salarioFuncionario" class="placeholderClaro" name="salario" placeholder="Salario">
                     <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if(!$salario){
                                echo "<div class='error'>
                                <p>Preencha o Salario de Forma Correta</p>
                                </div>";
                                $valido = false;
                            }else{
                                $valido = true;
                            }
                        }
                        ?>  
                    <div class="error" id="errorSalario"></div>

                    <input type="text" id="emailFuncionario" class="placeholderClaro" name="email" placeholder="Email">
                     <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if(!$email){
                                echo "<div class='error'>
                                <p>Preencha o Email de Forma Correta</p>
                                </div>";
                                $valido = false;
                            }else{
                                $valido = true;
                            }
                        }
                        ?>  
                    <div class="error" id="errorEmail"></div>

                    <input type="password" id="senhaFuncionario" class="placeholderClaro" name="senha" placeholder="Senha">
                     <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if(!$senha || $senha < 8){
                                echo "<div class='error'>
                                <p>Preencha a Senha de Forma Correta</p>
                                </div>";
                                $valido = false;
                            }else{
                                $valido = true;
                            }
                        }
                        ?>  
                    <div class="error" id="errorSenha"></div>

                    <input type="text" id="cpfFuncionario" class="placeholderClaro" name="cpf" placeholder="CPF">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                if(!$cpf || strlen($cpf) !== 11){
                                    echo "<div class='error'>
                                    <p>Preencha o CPF de Forma Correta</p>
                                    </div>";
                                    $valido = false;
                                }else{
                                    $valido = true;
                                }
                            }
                        ?>  
                    <div class="error" id="errorCpf"></div>                    

                    <label for="genero">
                        <select name="genero" id="generoFuncionario">
                            <option value="none">Gênero</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Prefiro não dizer">Prefiro não dizer</option>
                            <option value="Outro">Outro</option>
                        </select>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if(!$genero || $genero == 'none'){
                                echo "<div class='error'>
                                <p>Preencha o Gênero de Forma Correta</p>
                                </div>";
                                $valido = false;
                            }else{
                                $valido = true;
                            }
                        }
                        ?>  
                    <div class="error" id="errorGenero"></div>

                    <input type="date" id="dataNascimentoFuncionario" name="dataNascimento" placeholder="Data de Nascimento">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if(!$dataNascimento){
                                echo "<div class='error'>
                                <p>Preencha a Data de Nascimento de Forma Correta</p>
                                </div>";
                                $valido = false;
                            }else{
                                $valido = true;
                            }
                        }
                        ?>
                    <div class="error" id="errorDataNascimento"></div>

                    <label for="tipo" id="" name="" placeholder="Tipo Funcionario">
                        <select name="tipo" id="tipoFuncionario">
                            <option value="none">Tipo do Funcionario</option>
                            <option value="funcionario">Funcionario</option>
                            <option value="admin">Admin</option>
                        </select>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if(!$tipoFuncionario || $tipoFuncionario == 'none'){
                                echo "<div class='error'>
                                <p>Preencha o Tipo de Funcionario de Forma Correta</p>
                                </div>";
                                $valido = false;
                            }else{
                                $valido = true;
                            }
                        }
                        ?>    
                    <div class="error" id="errorTipo"></div>
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