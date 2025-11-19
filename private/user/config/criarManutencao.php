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
    $valido = true;
    
    if (!$tipoManutencao) {
        $valido = false;
        echo "<div class='mensagemErro'><p>Preencha o Tipo da Manutenção corretamente</p><a href='criarManutencao.php' class='fechar'>Fechar</a></div>";
    }
    if (!$descricao) {
        $valido = false;
        echo "<div class='mensagemErro'><p>Preencha a Descrição corretamente</p><a href='criarManutencao.php' class='fechar'>Fechar</a></div>";
    }
    if (!$estacao || $estacao == "none") {
        $valido = false;
        echo "<div class='mensagemErro'><p>Preencha a Estação corretamente</p><a href='criarManutencao.php' class='fechar'>Fechar</a></div>";
    }
    if (!$trem || $trem == "none") {
        $valido = false;
        echo "<div class='mensagemErro'><p>Preencha o Trem corretamente</p><a href='criarManutencao.php' class='fechar'>Fechar</a></div>";
    }
    
    if ($valido) {
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
                <select name="tipoManutencao" id="salarioFuncionario">
                    <option value="none">Tipo de Manutenção</option>
                    <?php
                        while ($rowTipo = $resultTipo->fetch_assoc()) {
                            echo "<option value='" . $rowTipo['tipoManutencao'] . "'";
                            echo ">" . $rowTipo['tipoManutencao'] . "</option>";
                        }
                    ?>
                </select>
            </label>
            <textarea class="placeholderClaro" placeholder="Descrição" name="descricao" id="cpfFuncionario"><?php echo isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : '' ?></textarea>
            <label class="placeholderClaro" name="estacao">
                <select name="idEstacao" id="nomeFuncionario">
                    <option value="none">Estação</option>
                    <?php
                        if ($resultEstacao) {
                            $resultEstacao->data_seek(0);
                            while ($rowEstacao = $resultEstacao->fetch_assoc()) {
                                echo "<option value='" . $rowEstacao['id'] . "'";
                                if(isset($_POST['idEstacao']) && $_POST['idEstacao'] == $rowEstacao['id']) echo ' selected';
                                echo ">" . $rowEstacao['nomeEstacao'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </label>
            <label class="placeholderClaro" name="trem">
                <select name="idTrem" id="emailFuncionario">
                    <option value="none">Trem</option>
                    <?php
                        if ($resultTrem) {
                            while ($rowTrem = $resultTrem->fetch_assoc()) {
                                echo "<option value='" . $rowTrem['id'] . "'";
                                if(isset($_POST['idTrem']) && $_POST['idTrem'] == $rowTrem['id']) echo ' selected';
                                echo ">" . $rowTrem['nome'] . "</option>";
                            }
                        }
                    ?>
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