<?php
session_start();
include '../../authGuard/authAdmin.php';

include '../../conexao/conexao.php';

include '../../consultaApis/viaCep.php';

function validarCPF($cpf) {
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) != 11 || preg_match('/^(\d)\1{10}$/', $cpf)) return false;
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
    $name = trim($_POST['nome'] ?? "");
    $email = trim($_POST['email'] ?? "");
    $rawSenha = $_POST['senha'] ?? "";
    $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
    $cargo = trim($_POST['cargo'] ?? "");
    $genero = $_POST['genero'] ?? "";
    $dataNascimento = $_POST['dataNascimento'] ?? "";
    $tipoFuncionario = $_POST['tipoFuncionario'] ?? "";
    $salario = floatval($_POST['salario'] ?? 0);
    $cep = $_POST['cep'] ?? "";
    $rua = $_POST['rua'] ?? "";
    $numero = $_POST['numero'] ?? "";
    $cidade = $_POST['cidade'] ?? "";
    $estado = $_POST['estado'] ?? "";

    $regexEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $regexSenha = '/^(?=(?:.*[A-Za-z]){5,})(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/';

    $errors = [];
    if (!preg_match('/^\p{Lu}/u', $name) || preg_match('/\d/', $name)) {
        $errors[] = "O nome não pode conter números e a primeira letra precisa ser maiúscula.";
    }
    if ($salario < 500 || $salario > 10000000) {
        $errors[] = "O salário deve ser entre 500 e 10000000.";
    }
    if (!preg_match($regexEmail, $email)) {
        $errors[] = "Digite um email válido com @ e .com.";
    }
    if (strlen($rawSenha) < 8 || !preg_match($regexSenha, $rawSenha)) {
        $errors[] = "A senha deve conter no mínimo 8 caracteres, 5 letras, 1 letra maiúscula, 1 caractere especial e número.";
    }
    if (!preg_match('/^\d{11}$/', $cpf) || !validarCPF($cpf)) {
        $errors[] = "Digite um CPF válido.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div class='mensagemCodigo'><p>$error</p><a href='cadastrarFuncionario.php' class='fechar'>Fechar</a></div>";
        }
    } else {
        $senha = password_hash($rawSenha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, cpf, cargo, tipo, genero, dataNascimento, salario, cep, rua, numero, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssssss", $name, $email, $senha, $cpf, $cargo, $tipoFuncionario, $genero, $dataNascimento, $salario, $cep, $rua, $numero, $cidade, $estado);

        if ($stmt->execute()) {
            echo "<div class='mensagemErro'><p>Novo Funcionário registrado com sucesso.</p><a href='cadastrarFuncionario.php' class='fechar'>Fechar</a></div>";
        } else {
            echo "<div class='mensagemErro'><p>Erro ao registrar funcionário.</p><a href='cadastrarFuncionario.php' class='fechar'>Fechar</a></div>";
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<?php
$id = $_GET['id'];

$sql = "SELECT * FROM usuarios WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$imgFileName = $row['imagemPerfil'];
if (!isset($imgFileName)) {
    $imgFileName = 'default.png';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['salvar'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        if ($_POST['senha'] === '') {
            $senha = $row['senha'];
        } else {
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
                            <label for="cargo">Cargo:</label><br>
                            <input type="text" name="cargo" id="cargo" value="<?php echo $row['cargo'] ?>" class="informacoesEspeciais" placeholder="Cargo"><br>
                            <div class="error" id="erroCargo"></div>
                        </div>

                        <div class="marginTopDown-2">
                            <label for="cargo">CPF:</label><br>
                            <input type="text" name="cpf" id="cpf" value="<?php echo $row['cpf'] ?>" class="informacoesEspeciais" placeholder="CPF"><br>
                            <div class="error" id="erroCPF"></div>
                        </div>

                        <div class="marginTopDown-2">
                            <label for="cargo">E-mail:</label><br>
                            <input type="text" name="email" id="email" value="<?php echo $row['email'] ?>" class="informacoesEspeciais" placeholder="E-mail"><br>
                            <div class="error" id="erroEmail"></div>
                        </div>

                        <div class="marginTopDown-2">
                            <label for="cargo">Nome de Usuário:</label><br>
                            <input type="text" name="nome" id="nomeUsuario" value="<?php echo $row['nome'] ?>" class="informacoesEspeciais" placeholder="Nome de Usuário">
                            <div class="error" id="erroNomeUsuario"></div>
                        </div>

                        <div class="marginTopDown-2">
                            <label for="cargo">Senha:</label><br>
                            <input type="text" name="senha" id="senhaUsuario" value="" class="informacoesEspeciais" placeholder="Senha">
                            <br><span>Deixe vazio para não alterar</span>
                            <div class="error" id="erroSenha"></div>
                        </div>

                        <div class="marginTopDown-2">
                            <label for="cargo">Salário:</label><br>
                            <input type="text" name="salario" id="salarioUsuario" value="<?php echo $row['salario'] ?>" class="informacoesEspeciais" placeholder="Salário">
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
                                    echo "<div class='marginTopDown-2'>
                                    <input type='text' name='rua' id='ruaUsuario' value='" . ($ruaApi ?? '') . "' class='informacoesEspeciais' placeholder='Rua' " . $sitRua . ">
                                    <div class='error' id='erroRua'></div>
                                </div>
                                
                                <div class='marginTopDown-2'>
                                    <input type='text' name='numero' id='numeroUsuario' value='' class='informacoesEspeciais' placeholder='Número'>
                                    <div class='error' id='erroNumero'></div>
                                </div>
                                
                                <div class='marginTopDown-2'>
                                    <input type='text' name='cidade' id='cidadeUsuario' value='" . ($cidadeApi ?? '') . "' class='informacoesEspeciais' placeholder='Cidade'" . $sitCidade . ">
                                    <div class='error' id='erroCidade'></div>
                                </div>
                                
                                <div class='marginTopDown-2'>
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

</html>