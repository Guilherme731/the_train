<?php
session_start();
include '../../authGuard/authAdmin.php';

include '../../conexao/conexao.php';

include '../../consultaApis/viaCep.php';

$id = $_GET['id'];

$sql = "SELECT * FROM usuarios WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$imgFileName = $row['imagemPerfil'];
if (!isset($imgFileName)) {
    $imgFileName = 'default.png';
}

function validarCPF($cpf) {
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) != 11) return false;
    if (preg_match('/^(\d)\1{10}$/', $cpf)) return false;
    for ($t = 9; $t < 11; $t++) {
        $soma = 0;
        for ($i = 0; $i < $t; $i++) {
            $soma += (int)$cpf[$i] * (($t + 1) - $i);
        }
        $digito = (11 - ($soma % 11));
        if ($digito >= 10) $digito = 0;
        if ($cpf[$t] != $digito) return false;
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['salvar'])) {
        $name = $_POST['nome'] ?? "";
        $email = $_POST['email'] ?? "";
        $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
        $cargo = $_POST['cargo'] ?? "";
        $salario = $_POST['salario'] ?? "";
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $regexEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

       $sql = "UPDATE usuarios SET nome = '$name',email = '$email',cpf = '$cpf', cargo = '$cargo',salario = '$salario', cep = '$cep', rua = '$rua', numero = '$numero', cidade = '$cidade', estado = '$estado' WHERE id=$id";

         if(!preg_match('/\p{Lu}/u', $name) || preg_match('/\d/', $name)){
        echo "<div class='mensagemCodigo'>
        <p>O nome não pode conter números e a primeira letra precisa ser maiúscula</p>
        <a href='editarPerfilUsuario.php?id=$id' class='fechar'>Fechar</a>
        </div>";  
        } else if($salario < 500 || $salario > 10000000){
        echo "<div class='mensagemCodigo'>
        <p>O salário deve ser entre 500 e 10000000</p>
        <a href='editarPerfilUsuario.php?id=$id' class='fechar'>Fechar</a>
        </div>";    
        } else if(!preg_match($regexEmail, $email)){
        echo "<div class='mensagemCodigo'>
        <p>Digite um email válido com @ e .com</p>
        <a href='editarPerfilUsuario.php?id=$id' class='fechar'>Fechar</a>
        </div>";  
        } else if (!preg_match('/^\d{11}$/', $cpf)) {
        echo "<div class='mensagemCodigo'>
        <p>Digite um CPF válido</p>
        <a href='editarPerfilUsuario.php?id=$id' class='fechar'>Fechar</a>
        </div>"; 
        } else if (!validarCPF($cpf)) {
        echo "<div class='mensagemCodigo'>
        <p>Digite um CPF válido</p>
        <a href='editarPerfilUsuario.php?id=$id' class='fechar'>Fechar</a>
        </div>"; 
        } else if ($conn->query($sql) === true) {
             echo "<div class='mensagemErro'> 
        <p>Funcionário atualizado com sucesso.</p>
        <a href='selecionarUsuario.php' class='fechar'>Fechar</a>
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
    <title>Editar Perfil De Usuário</title>
</head>

<body>
    <header class="headerAzulVoltar">
        <a href="selecionarUsuario.php"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main>
        <div class="gridCentro">

            <h2 class="tituloAzul">Editar Perfil De Usuário</h2>

            <img id="imagemUsuario" src="../../user/uploads/<?= $imgFileName ?>" alt="Icone do funcionario">


            <h3 class="textoCentral"><?php echo $row['nome'] ?></h3>
        </div>

        <form action="" method="POST" id="formularioEditarPerfilUsuario">
            <div id="centroPerfil">
                <div class="flexCentro">
                    <div id="informacoesEspeciaisUser">
                        <div class="marginTopDown-2">
                                 <label for="cargo" id="" class="placeholderClaro">
                        <select name="cargo" id="cargoFuncionario" required>
                            <option value="" disabled selected>Cargo</option>
                            <option value="Administrador" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Administrador') echo 'selected'; ?>>Administrador</option>
                            <option value="Mecânico" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Mecânico') echo 'selected'; ?>>Mecânico</option>
                            <option value="Faxineiro" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Faxineiro') echo 'selected'; ?>>Faxineiro</option>
                            <option value="Supervisor" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Supervisor') echo 'selected'; ?>>Supervisor</option>
                            <option value="Operário" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Operário') echo 'selected'; ?>>Operário</option>
                            <option value="Piloto" <?php if(isset($_POST['cargo']) && $_POST['cargo']==='Piloto') echo 'selected'; ?>>Piloto</option> 
                        </select>
                            <div class="error" id="erroCargo"></div>
                        </div>

                        <div class="marginTopDown-2">
                            <input type="text" id="cpfFuncionario" class="placeholderClaro" name="cpf" placeholder="CPF" value="<?php echo isset($_POST['cpf']) ? htmlspecialchars($_POST['cpf']) : '' ?>" required>
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
                                if(!preg_match('/^\d{11}$/', $cpf)){
                                    echo "<div class='error'>
                                    <p>Preencha o CPF com 11 números (somente dígitos)</p>
                                    </div>";
                                    $valido = false;
                                } else if(!validarCPF($cpf)){
                                    echo "<div class='error'>
                                    <p>CPF inválido</p>
                                    </div>";
                                    $valido = false;
                                }else{
                                    $valido = true;
                                }
                            }
                        ?>  
                    <div class="error" id="errorCpf"></div>                    
                        </div>

                        <div class="marginTopDown-2">
                            <input type="text" id="emailFuncionario" class="placeholderClaro" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                            <div class="error" id="erroEmail"></div>
                        </div>

                        <div class="marginTopDown-2">
                            <input type="text" id="nomeFuncionario" class="placeholderClaro" name="nome" placeholder="Nome" value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '' ?>" required>
                            <div class="error" id="erroNomeUsuario"></div>
                        </div>

                        <div class="marginTopDown-2">
                            <input type="text" id="salarioFuncionario" class="placeholderClaro" name="salario" placeholder="Salario" value="<?php echo isset($_POST['salario']) ? htmlspecialchars($_POST['salario']) : '' ?>" required>
                            <div class="error" id="erroSalario"></div>
                        </div>



                    </div>
                </div>
            </div>
            <div style="padding-top: 10px;"></div>
            <div id="centroPerfil">
                <div class="flexCentro">
                    <div id="informacoesEspeciaisUser">
                        <div class="marginTopDown-2">
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                            if (isset($_POST['carregarCep'])) {
                                echo "<input type='text' name='cep' id='cepUsuario' value='{$_POST['cep']}' class='informacoesEspeciais' placeholder='CEP' readonly>";
                                echo "<br> <a href='' style='text-decoration:none;'>Voltar</a>";
                            }
                            else{
                                echo "<input type='text' name='cep' id='cepUsuario' value='{$row['cep']}' class='informacoesEspeciais' placeholder='CEP'>";
                                echo "<br> <input type='submit' name='carregarCep' value='Confirmar CEP'>";
                            }
                        }else{
                                echo "<input type='text' name='cep' id='cepUsuario' value='{$row['cep']}' class='informacoesEspeciais' placeholder='CEP'>";
                                echo "<br> <input type='submit' name='carregarCep'  class='confirmarCep' value='Confirmar CEP'>";

                            }
                        ?>

                            <div class="error" id="erroCep"></div>
                        </div>




                        <?php

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                            if (isset($_POST['carregarCep'])) {
                                $sql = "SELECT * FROM usuarios WHERE id = $id";
                                $result = ($conn->query($sql))->fetch_assoc();

                                $apiResponse = obterDadosCep($_POST['cep']);
                                $sitRua = ($apiResponse[0] != null)? ' readonly' : '';
                                $sitCidade = ($apiResponse[1] != null)? ' readonly' : '';
                                $sitEstado = ($apiResponse[2] != null)? ' readonly' : '';
                                $ruaApi = (is_array($apiResponse) && isset($apiResponse[0]) && $apiResponse[0] !== null) ? $apiResponse[0] : null;
                                $cidadeApi = (is_array($apiResponse) && isset($apiResponse[1]) && $apiResponse[1] !== null) ? $apiResponse[1] : null;
                                $estadoApi = (is_array($apiResponse) && isset($apiResponse[2]) && $apiResponse[2] !== null) ? $apiResponse[2] : null;

                                
                                $sitRua = ($ruaApi !== null) ? ' readonly' : '';
                                $sitCidade = ($cidadeApi !== null) ? ' readonly' : '';
                                $sitEstado = ($estadoApi !== null) ? ' readonly' : '';

                                if($_POST['cep'] == $result['cep']){
                                    echo "<div class='marginTopDown-2'>
                                    <input type='text' name='rua' id='ruaUsuario' value='" . $row['rua'] . "' class='informacoesEspeciais' placeholder='Rua'" . $sitRua . ">
                                    <div class='error' id='erroRua'></div>
                                </div>

                                <div class='marginTopDown-2'>
                                    <input type='text' name='numero' id='numeroUsuario' value='" . $row['numero'] . "' class='informacoesEspeciais' placeholder='Número'>
                                    <div class='error' id='erroNumero'></div>
                                </div>

                                <div class='marginTopDown-2'>
                                    <input type='text' name='cidade' id='cidadeUsuario' value='" . $row['cidade'] . "' class='informacoesEspeciais' placeholder='Cidade'" . $sitCidade . ">
                                    <div class='error' id='erroCidade'></div>
                                </div>

                                <div class='marginTopDown-2'>
                                    <input type='text' name='estado' id='estadoUsuario' value='" . $row['estado'] . "' class='informacoesEspeciais' placeholder='Estado'" . $sitEstado . ">
                                    <div class='error' id='erroEstado'></div>
                                </div>";
                                }else{
                                    $apiResponse = obterDadosCep($_POST['cep']);
                                    $sitRua = ($apiResponse[0] != null)? ' readonly' : '';
                                    $sitCidade = ($apiResponse[1] != null)? ' readonly' : '';
                                    $sitEstado = ($apiResponse[2] != null)? ' readonly' : '';
                                    echo "<div class='marginTopDown-2'>
                                    <input type='text' name='rua' id='ruaUsuario' value='" . $apiResponse[0] . "' class='informacoesEspeciais' placeholder='Rua' " . $sitRua . ">
                                    <input type='text' name='rua' id='ruaUsuario' value='" . ($ruaApi ?? '') . "' class='informacoesEspeciais' placeholder='Rua' " . $sitRua . ">
                                    <div class='error' id='erroRua'></div>
                                </div>

                                
                                <div class='marginTopDown-2'>
                                    <input type='text' name='numero' id='numeroUsuario' value='' class='informacoesEspeciais' placeholder='Número'>
                                    <div class='error' id='erroNumero'></div>
                                </div>

                                
                                <div class='marginTopDown-2'>
                                    <input type='text' name='cidade' id='cidadeUsuario' value='" . $apiResponse[1] . "' class='informacoesEspeciais' placeholder='Cidade'" . $sitCidade . ">
                                    <input type='text' name='cidade' id='cidadeUsuario' value='" . ($cidadeApi ?? '') . "' class='informacoesEspeciais' placeholder='Cidade'" . $sitCidade . ">
                                    <div class='error' id='erroCidade'></div>
                                </div>

                                
                                <div class='marginTopDown-2'>
                                    <input type='text' name='estado' id='estadoUsuario' value='" . $apiResponse[2] . "' class='informacoesEspeciais' placeholder='Estado' " . $sitEstado . ">
                                    <input type='text' name='estado' id='estadoUsuario' value='" . ($estadoApi ?? '') . "' class='informacoesEspeciais' placeholder='Estado' " . $sitEstado . ">
                                    <div class='error' id='erroEstado'></div>
                                </div>";
                                }


                            }
                        }

                        ?>




                    </div>
                </div>
            </div>

            <div class="flex">
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (isset($_POST['carregarCep'])) {
                            echo "<input id='botaoSalvarEditarPerfil' type='submit' name='salvar' value='Salvar'>";
                        }
                    }  else{
                        echo "<input id='botaoSalvarEditarPerfil' type='submit' name='salvar' value='Salvar' disabled>";
                    }
                ?>
            </div>

        </form>
    </main>
    <div class="espacoFooterAzulLogo"></div>
    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>

</body>
