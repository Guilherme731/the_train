<?php
session_start();
include '../../authGuard/authAdmin.php';

include '../../conexao/conexao.php';

include '../../consultaApis/viaCep.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //$valido = false;
if (isset($_POST['cadastrar'])) {
    $name = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $genero = $_POST['genero'];
    $dataNascimento = $_POST['dataNascimento'];
    $tipoFuncionario = $_POST['tipoFuncionario'];
    $salario = $_POST['salario'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $sql = " INSERT INTO usuarios (nome,email,senha,cpf,cargo,tipo,genero,dataNascimento,salario, cep, rua, numero, cidade, estado) VALUE ('$name','$email','$senha', '$cpf', '$cargo', '$tipoFuncionario', '$genero', '$dataNascimento', '$salario', '$cep', '$rua', '$numero', '$cidade', '$estado')";   

    //if($valido == true){
        if ($conn->query($sql) === true) {
            echo "<div class='mensagemErro'> 
        <p>Novo Funcionário registrado com sucesso.</p>
        <a href='cadastrarFuncionario.php' class='fechar'>Fechar</a>
            </div>";
        } else {
            echo "<div class='mensagemErro'> 
        <p>Erro</p>
        <a href='cadastrarFuncionario.php' class='fechar'>Fechar</a>
            </div>" . $sql . '<br>' . $conn->error;
        }
        $conn->close();
    //}

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
            <form id="validarCadastroFuncionario" action="" method="POST">
                <div id="quadradoCadastroFuncionario">
                    

                    <input type="text" id="nomeFuncionario" class="placeholderClaro" name="nome" placeholder="Nome" value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '' ?>">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
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
                            <option value="Administrador" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Administrador') echo 'selected'; ?>>Administrador</option>
                            <option value="Mecânico" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Mecânico') echo 'selected'; ?>>Mecânico</option>
                            <option value="Faxineiro" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Faxineiro') echo 'selected'; ?>>Faxineiro</option>
                            <option value="Supervisor" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Supervisor') echo 'selected'; ?>>Supervisor</option>
                            <option value="Operário" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Operário') echo 'selected'; ?>>Operário</option>
                            <option value="Piloto" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Piloto') echo 'selected'; ?>>Piloto</option> 
                        </select>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
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
                    

                    <input type="text" id="salarioFuncionario" class="placeholderClaro" name="salario" placeholder="Salario" value="<?php echo isset($_POST['salario']) ? htmlspecialchars($_POST['salario']) : '' ?>">
                     <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
                            if(!$salario){
                                echo "<div class='error'>
                                <p>Preencha o Salário de Forma Correta</p>
                                </div>";
                                $valido = false;
                            }else{
                                $valido = true;
                            }
                        }
                        ?>  
                    <div class="error" id="errorSalario"></div>

                    <input type="text" id="emailFuncionario" class="placeholderClaro" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                     <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
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

                    <input type="password" id="senhaFuncionario" class="placeholderClaro" name="senha" placeholder="Senha" value="<?php echo isset($_POST['senha']) ? htmlspecialchars($_POST['senha']) : '' ?>">
                     <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
                            if(!$senha || $senha > 8){
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

                    <input type="text" id="cpfFuncionario" class="placeholderClaro" name="cpf" placeholder="CPF" value="<?php echo isset($_POST['cpf']) ? htmlspecialchars($_POST['cpf']) : '' ?>">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
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
                            <option value="Feminino" <?php if(isset($_POST['genero']) && $_POST['genero']==='Feminino') echo 'selected'; ?>>Feminino</option>
                            <option value="Masculino" <?php if(isset($_POST['genero']) && $_POST['genero']==='Masculino') echo 'selected'; ?>>Masculino</option>
                            <option value="Prefiro não dizer" <?php if(isset($_POST['genero']) && $_POST['genero']==='Prefiro não dizer') echo 'selected'; ?>>Prefiro não dizer</option>
                            <option value="Outro" <?php if(isset($_POST['genero']) && $_POST['genero']==='Outro') echo 'selected'; ?>>Outro</option>
                        </select>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
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

                    <input type="date" id="dataNascimentoFuncionario" name="dataNascimento" placeholder="Data de Nascimento" value="<?php echo isset($_POST['dataNascimento']) ? htmlspecialchars($_POST['dataNascimento']) : '' ?>">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
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

                    <label for="tipo" id="tipoFuncionario" name="tipoFuncionario" placeholder="Tipo Funcionario">
                        <select name="tipoFuncionario" id="tipoFuncionario">
                            <option value="none">Tipo do Funcionário</option>
                            <option value="funcionario" <?php if(isset($_POST['tipoFuncionario']) && $_POST['tipoFuncionario']==='funcionario') echo 'selected'; ?>>Funcionário</option>
                            <option value="admin" <?php if(isset($_POST['tipoFuncionario']) && $_POST['tipoFuncionario']==='admin') echo 'selected'; ?>>Admin</option>
                        </select>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
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

                    <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                            if (isset($_POST['carregarCep'])) {
                                echo "<input type='text' id='cepFuncionario' value='" . (isset($_POST['cep']) ? htmlspecialchars($_POST['cep']) : '') . "' class='placeholderClaro' name='cep' placeholder='CEP' readonly>";
                                echo "<br> <a href=''>Voltar</a>";
                            }
                            else{
                                echo "<input type='text' id='cepFuncionario' class='placeholderClaro' name='cep' placeholder='CEP' value='" . (isset($_POST['cep']) ? htmlspecialchars($_POST['cep']) : '') . "'>";
                                echo "<br> <input type='submit' name='carregarCep' value='Confirmar CEP'>";
                            }
                        }else{
                                echo "<input type='text' id='cepFuncionario' class='placeholderClaro' name='cep' placeholder='CEP'>";
                                echo "<br> <input type='submit' name='carregarCep' value='Confirmar CEP'>";

                            }
                            ?> 
                    <div class="error" id="errorCEP"></div>   

                        <?php
                        
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                            if (isset($_POST['carregarCep'])) {

                                $apiResponse = obterDadosCep($_POST['cep']);
                                    $sitRua = ($apiResponse[0] != null)? ' readonly' : '';
                                    $sitCidade = ($apiResponse[1] != null)? ' readonly' : '';
                                    $sitEstado = ($apiResponse[2] != null)? ' readonly' : '';
                                    echo "<div class='marginTopDown-2'>
                                    <input type='text' name='rua' id='ruaFuncionario' value='" . (isset($apiResponse[0]) ? htmlspecialchars($apiResponse[0]) : (isset($_POST['rua']) ? htmlspecialchars($_POST['rua']) : '')) . "' class='placeholderClaro' placeholder='Rua' " . $sitRua . ">
                                    <div class='error' id='erroRua'></div>
                                </div>

                                <div class='marginTopDown-2'>
                                    <input type='text' name='numero' id='numeroFuncionario' value='" . (isset($_POST['numero']) ? htmlspecialchars($_POST['numero']) : '') . "' class='placeholderClaro' placeholder='Número'>
                                    <div class='error' id='erroNumero'></div>
                                </div>

                                <div class='marginTopDown-2'>
                                    <input type='text' name='cidade' id='cidadeFuncionario' value='" . (isset($apiResponse[1]) ? htmlspecialchars($apiResponse[1]) : (isset($_POST['cidade']) ? htmlspecialchars($_POST['cidade']) : '')) . "' class='placeholderClaro' placeholder='Cidade'" . $sitCidade . ">
                                    <div class='error' id='erroCidade'></div>
                                </div>

                                <div class='marginTopDown-2'>
                                    <input type='text' name='estado' id='estadoFuncionario' value='" . (isset($apiResponse[2]) ? htmlspecialchars($apiResponse[2]) : (isset($_POST['estado']) ? htmlspecialchars($_POST['estado']) : '')) . "' class='placeholderClaro' placeholder='Estado' " . $sitEstado . ">
                                    <div class='error' id='erroEstado'></div>
                                </div>";


                            }
                        }
                        
                        ?>
                    
                    </div>
                        <div class="flexCentro">
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                            if (isset($_POST['carregarCep'])) {
                                echo "<button id='botaoSubmit' type='submit' name='cadastrar'>";
                            }
                        }  else{
                            echo "<button id='botaoSubmit' type='submit' name='cadastrar' disabled>";
                        }
                                ?>
                            
                                <div class="flexCentro">
                                    <img class="iconeCadastrarFuncionarioTamanho" src="../../../assets/icons/config/cadastroFuncionarioIcone.png">
                                    <div id="botaoCadastrar">
                                        <h2 id="textoCadastrar">Cadastrar</h2>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div></a>
    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>

</body>

</html>