<?php
session_start();
include '../../conexao/conexao.php';
include '../../authGuard/authUsuario.php';

$sqlEstacao = "SELECT id, nomeEstacao FROM estacoes";
$resultEstacao = $conn->query($sqlEstacao);

$sqlTrem = "SELECT id, nome FROM trens";
$resultTrem = $conn->query($sqlTrem);

$sqlManutebcaoTipo = "SELECT DISTINCT tipoManutencao FROM manutencoes";
$resultTipo = $conn->query($sqlManutebcaoTipo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipoManutencao = isset($_POST['tipoManutencao']) ? trim($_POST['tipoManutencao']) : '';
    $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';
    $estacao = isset($_POST['idEstacao']) ? $_POST['idEstacao'] : '';
    $trem = isset($_POST['idTrem']) ? $_POST['idTrem'] : '';
   
        $stmt = $conn->prepare("INSERT INTO manutencoes (tipoManutencao, descricao, idEstacao, idTrem) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $tipoManutencao, $descricao, $estacao, $trem);
        if ($stmt->execute()) {
            echo "<div class='mensagemErro'><p>Nova manutenção registrada com sucesso.</p><a href='criarManutencao.php' class='fechar'>Fechar</a></div>";
        } else {
            echo "<div class='mensagemErro'><p>Erro ao registrar manutenção.</p><a href='criarManutencao.php' class='fechar'>Fechar</a></div>";
        }
        $stmt->close();
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Criar Manutenção</title>
    <script src="../../../scripts/botoesMenus.js"></script>
    <link rel="stylesheet" href="../../../style/style.css">
</head>
<body>
    <header class="headerAzulVoltar">
        <a href="<?php echo '../manutencao/manutencao.php';?>"><img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
    </header>

    <main>
        
        <h1 class="tituloAzul">Criar Manutenção</h1>

    <form method="POST" action="">
    <div class="flexCentro textoCentral">
        <div id="manutencao">
            <label class="placeholderClaro" name="tipo">
                <select name="tipoManutencao" id="salarioFuncionario" required>
                    <option value="" disabled selected>Tipo de Manutenção</option>
                    <option value="Manutenções Preventivas" <?php if(isset($_POST['tipoManutencao']) && $_POST['tipoManutencao']==='Manutenções Preventivas') echo 'selected'; ?>>Manutenções Preventivas</option>
                    <option value="Controle de Inspeções" <?php if(isset($_POST['tipoManutencao']) && $_POST['tipoManutencao']==='Controle de Inspeções') echo 'selected'; ?>>Controle de inspeções</option>
                </select>
            </label>
            <textarea class="placeholderClaro" placeholder="Descrição" name="descricao" id="cpfFuncionario" required><?php echo isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : '' ?></textarea>
            <label class="placeholderClaro" name="estacao">
                <select name="idEstacao" id="nomeFuncionario" required>
                    <option value="" disabled selected>Estação</option>
                    <option value="Estação Aurora" <?php if(isset($_POST['idEstacao']) && $_POST['idEstacao']==='Estação Aurora') echo 'selected'; ?>>Estação Aurora</option>
                    <option value="Estação Vila Nova" <?php if(isset($_POST['idEstacao']) && $_POST['idEstacao']==='Estação Vila Nova') echo 'selected'; ?>>Estação Vila Nova</option>
                    <option value="Estação Vale Verde" <?php if(isset($_POST['idEstacao']) && $_POST['idEstacao']==='Estação Vale Verde') echo 'selected'; ?>>Estação Vale Verde</option>
                </select>
            </label>
            <label class="placeholderClaro" name="trem">
                <select name="idTrem" id="emailFuncionario" required>
                    <option value="" disabled selected>Trem</option>
                    <option value="Trem Expresso 1" <?php if(isset($_POST['idTrem']) && $_POST['idTrem']==='Trem Expresso 1') echo 'selected'; ?>>Trem Expresso 1</option>
                    <option value="Trem Regional 2" <?php if(isset($_POST['idTrem']) && $_POST['idTrem']==='Trem Regional 2') echo 'selected'; ?>>Trem Regional 2 </option>
                    <option value="Trem Urbano 3" <?php if(isset($_POST['idTrem']) && $_POST['idTrem']==='Trem Urbano 3') echo 'selected'; ?>>Trem Urbano 3</option>
                </select>
            </label>
        </div>
    </div>
    <div class="flexCentro textoCentral">
        <button type="submit" id="botaoSalvar">Criar</button>
    </div>
    </form>

    </main>

    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
    
</body>
</html>