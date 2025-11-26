<?php
session_start();
include '../../conexao/conexao.php';
include '../../authGuard/authUsuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tipoManutencao = $_POST['tipoManutencao'] ?? "";
        $idEstacao = $_POST['idEstacao'] ?? "";
        $idTrem = $_POST['idTrem'] ?? "";
        $descricao = $_POST['descricao'] ?? "";

        $sql = "INSERT INTO manutencoes (tipoManutencao, idEstacao, idTrem, descricao) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siis", $tipoManutencao, $idEstacao, $idTrem, $descricao);
        $stmt->execute();

        echo "<div class='mensagemErro'> 
        <p>Nova manutenção registrada com sucesso!</p>
        <a href='../manutencao/manutencao.php' class='fechar'>Voltar para as manutenções</a>
        </div>";
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
                    <option value="Manutenções Preventivas" <?php if(isset($_POST['tipoManutencao']) && $_POST['tipoManutencao']==='Manutenções Preventivas') echo 'selected'; ?>>Manutenção Preventiva</option>
                    <option value="Controle de inspeções" <?php if(isset($_POST['tipoManutencao']) && $_POST['tipoManutencao']==='Controle de Inspeções') echo 'selected'; ?>>Controle de inspeção</option>
                </select>
            </label>
            <textarea class="placeholderClaro" placeholder="Descrição" name="descricao" id="cpfFuncionario" required><?php echo isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : '' ?></textarea>
            <label class="placeholderClaro" name="estacao">
                <select name="idEstacao" id="nomeFuncionario" required>
                    <option value="" disabled selected>Estação</option>
                    <option value="1" <?php if(isset($_POST['idEstacao']) && $_POST['idEstacao']==='Estação Aurora') echo 'selected'; ?>>Estação Aurora</option>
                    <option value="2" <?php if(isset($_POST['idEstacao']) && $_POST['idEstacao']==='Estação Vila Nova') echo 'selected'; ?>>Estação Vila Nova</option>
                    <option value="3" <?php if(isset($_POST['idEstacao']) && $_POST['idEstacao']==='Estação Vale Verde') echo 'selected'; ?>>Estação Vale Verde</option>
                </select>
            </label>
            <label class="placeholderClaro" name="trem">
                <select name="idTrem" id="emailFuncionario" required>
                    <option value="" disabled selected>Trem</option>
                    <option value="1" <?php if(isset($_POST['idTrem']) && $_POST['idTrem']==='Trem Expresso 1') echo 'selected'; ?>>Trem Expresso 1</option>
                    <option value="2" <?php if(isset($_POST['idTrem']) && $_POST['idTrem']==='Trem Regional 2') echo 'selected'; ?>>Trem Regional 2 </option>
                    <option value="3" <?php if(isset($_POST['idTrem']) && $_POST['idTrem']==='Trem Urbano 3') echo 'selected'; ?>>Trem Urbano 3</option>
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