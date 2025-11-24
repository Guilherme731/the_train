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


?>


<?php
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: selecionarUsuario.php');
    exit();
}


$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();


if (!$row) {
    echo "<div class='mensagemErro'><p>Usuário não encontrado.</p></div>";
    exit();
}


$imgFileName = $row['imagemPerfil'] ?? 'default.png';


$errors = [];
$cepReadonly = '';
$ruaReadonly = '';
$cidadeReadonly = '';
$estadoReadonly = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['carregarCep'])) {
        $cepPost = preg_replace('/\D/', '', $_POST['cep'] ?? '');
        $apiResponse = obterDadosCep($cepPost);
        $ruaApi = is_array($apiResponse) && isset($apiResponse[0]) ? $apiResponse[0] : null;
        $cidadeApi = is_array($apiResponse) && isset($apiResponse[1]) ? $apiResponse[1] : null;
        $estadoApi = is_array($apiResponse) && isset($apiResponse[2]) ? $apiResponse[2] : null;


        if ($ruaApi !== null) $ruaReadonly = ' readonly';
        if ($cidadeApi !== null) $cidadeReadonly = ' readonly';
        if ($estadoApi !== null) $estadoReadonly = ' readonly';


        $row['cep'] = $cepPost;
        $row['rua'] = $ruaApi ?? $row['rua'];
        $row['cidade'] = $cidadeApi ?? $row['cidade'];
        $row['estado'] = $estadoApi ?? $row['estado'];
        $row['numero'] = $row['numero'] ?? '';
    }


    if (isset($_POST['salvar'])) {
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $rawSenha = $_POST['senha'] ?? '';
        $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
        $cargo = trim($_POST['cargo'] ?? '');
        $salario = floatval(str_replace(',', '.', $_POST['salario'] ?? 0));
        $cep = preg_replace('/\D/', '', $_POST['cep'] ?? '');
        $rua = trim($_POST['rua'] ?? '');
        $numero = trim($_POST['numero'] ?? '');
        $cidade = trim($_POST['cidade'] ?? '');
        $estado = trim($_POST['estado'] ?? '');


        $regexEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $regexSenha = '/^(?=(?:.*[A-Za-z]){5,})(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/';


        if (!preg_match('/^\p{Lu}/u', $nome) || preg_match('/\d/', $nome)) {
            $errors[] = "O nome não pode conter números e a primeira letra precisa ser maiúscula.";
        }
        if ($salario < 500 || $salario > 10000000) {
            $errors[] = "O salário deve ser entre 500 e 10000000.";
        }
        if (!preg_match($regexEmail, $email)) {
            $errors[] = "Digite um email válido.";
        }
        if ($rawSenha !== '' && (strlen($rawSenha) < 8 || !preg_match($regexSenha, $rawSenha))) {
            $errors[] = "A senha deve conter no mínimo 8 caracteres, 5 letras, 1 letra maiúscula, 1 caractere especial e número.";
        }
        if (!preg_match('/^\d{11}$/', $cpf) || !validarCPF($cpf)) {
            $errors[] = "Digite um CPF válido.";
        }


        if (!empty($errors)) {
            $row['nome'] = $nome;
            $row['email'] = $email;
            $row['cpf'] = $cpf;
            $row['cargo'] = $cargo;
            $row['salario'] = $salario;
            $row['cep'] = $cep;
            $row['rua'] = $rua;
            $row['numero'] = $numero;
            $row['cidade'] = $cidade;
            $row['estado'] = $estado;
        } else {
            if ($rawSenha === '') {
                $senhaHash = $row['senha'];
            } else {
                $senhaHash = password_hash($rawSenha, PASSWORD_DEFAULT);
            }


            $update = $conn->prepare("UPDATE usuarios SET nome=?, email=?, senha=?, cpf=?, cargo=?, salario=?, cep=?, rua=?, numero=?, cidade=?, estado=? WHERE id=?");
            $update->bind_param('sssssdsssssi', $nome, $email, $senhaHash, $cpf, $cargo, $salario, $cep, $rua, $numero, $cidade, $estado, $id);


            if ($update->execute()) {
                $update->close();
                $conn->close();
                header('Location: selecionarUsuario.php');
                exit();
            } else {
                $errors[] = 'Erro ao atualizar usuário: ' . $conn->error;
                $update->close();
            }
        }
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


            <img id="imagemUsuario" src="../../user/uploads/<?php echo htmlspecialchars($imgFileName); ?>" alt="Icone do funcionario">




            <h3 class="textoCentral"><?php echo htmlspecialchars($row['nome']); ?></h3>
        </div>


        <form action="" method="POST" id="formularioEditarPerfilUsuario">
            <div id="centroPerfil">
                <div class="flexCentro">
                    <div id="informacoesEspeciaisUser">
                        <div class="marginTopDown-2">
                            <label for="cargo">Cargo:</label><br>
                            <input type="text" name="cargo" id="cargo" value="<?php echo htmlspecialchars($row['cargo'] ?? ''); ?>" class="informacoesEspeciais" placeholder="Cargo"><br>
                            <div class="error" id="erroCargo"></div>
                        </div>


                        <div class="marginTopDown-2">
                            <label for="cpf">CPF:</label><br>
                            <input type="text" name="cpf" id="cpf" value="<?php echo htmlspecialchars($row['cpf'] ?? ''); ?>" class="informacoesEspeciais" placeholder="CPF"><br>
                            <div class="error" id="erroCPF"></div>
                        </div>


                        <div class="marginTopDown-2">
                            <label for="email">E-mail:</label><br>
                            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($row['email'] ?? ''); ?>" class="informacoesEspeciais" placeholder="E-mail"><br>
                            <div class="error" id="erroEmail"></div>
                        </div>


                        <div class="marginTopDown-2">
                            <label for="nomeUsuario">Nome de Usuário:</label><br>
                            <input type="text" name="nome" id="nomeUsuario" value="<?php echo htmlspecialchars($row['nome'] ?? ''); ?>" class="informacoesEspeciais" placeholder="Nome de Usuário">
                            <div class="error" id="erroNomeUsuario"></div>
                        </div>


                        <div class="marginTopDown-2">
                            <label for="senhaUsuario">Senha:</label><br>
                            <input type="password" name="senha" id="senhaUsuario" value="" class="informacoesEspeciais" placeholder="Senha">
                            <br><span>Deixe vazio para não alterar</span>
                            <div class="error" id="erroSenha"></div>
                        </div>


                        <div class="marginTopDown-2">
                            <label for="salarioUsuario">Salário:</label><br>
                            <input type="text" name="salario" id="salarioUsuario" value="<?php echo htmlspecialchars($row['salario'] ?? ''); ?>" class="informacoesEspeciais" placeholder="Salário">
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
                            <label for="cepUsuario">CEP:</label><br>
                            <input type="text" name="cep" id="cepUsuario" value="<?php echo htmlspecialchars($row['cep'] ?? ''); ?>" class="informacoesEspeciais" placeholder="CEP"<?php echo $cepReadonly; ?>>
                            <br>
                            <input type="submit" name="carregarCep" class="confirmarCep" value="Confirmar CEP">
                            <div class="error" id="erroCep"></div>
                        </div>


                        <div class="marginTopDown-2">
                            <input type="text" name="rua" id="ruaUsuario" value="<?php echo htmlspecialchars($row['rua'] ?? ''); ?>" class="informacoesEspeciais" placeholder="Rua"<?php echo $ruaReadonly; ?>>
                            <div class="error" id="erroRua"></div>
                        </div>


                        <div class="marginTopDown-2">
                            <input type="text" name="numero" id="numeroUsuario" value="<?php echo htmlspecialchars($row['numero'] ?? ''); ?>" class="informacoesEspeciais" placeholder="Número">
                            <div class="error" id="erroNumero"></div>
                        </div>


                        <div class="marginTopDown-2">
                            <input type="text" name="cidade" id="cidadeUsuario" value="<?php echo htmlspecialchars($row['cidade'] ?? ''); ?>" class="informacoesEspeciais" placeholder="Cidade"<?php echo $cidadeReadonly; ?>>
                            <div class="error" id="erroCidade"></div>
                        </div>


                        <div class="marginTopDown-2">
                            <input type="text" name="estado" id="estadoUsuario" value="<?php echo htmlspecialchars($row['estado'] ?? ''); ?>" class="informacoesEspeciais" placeholder="Estado"<?php echo $estadoReadonly; ?>>
                            <div class="error" id="erroEstado"></div>
                        </div>


                       




                    </div>
                </div>
            </div>


            <div class="flex">
                <?php
                    if (!empty($errors)) {
                        foreach ($errors as $error) {
                            echo "<div class='mensagemCodigo'><p>" . htmlspecialchars($error) . "</p></div>";
                        }
                    }
                    echo "<input id='botaoSalvarEditarPerfil' type='submit' name='salvar' value='Salvar'>";
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