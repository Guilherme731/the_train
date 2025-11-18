<?php
session_start();
include '../../../authGuard/authUsuario.php';
include '../../../conexao/conexao.php';
$id = $_SESSION['user_id'];

$numero1 = $_POST["numero1"] ?? "";
$numero2 = $_POST["numero2"] ?? "";
$numero3 = $_POST["numero3"] ?? "";
$numero4 = $_POST["numero4"] ?? "";
$numero5 = $_POST["numero5"] ?? "";
$numero6 = $_POST["numero6"] ?? "";

    $stmt = $conn->prepare('SELECT codigo_1, codigo_2, codigo_3, codigo_4, codigo_5, codigo_6 FROM codigos WHERE id = ? LIMIT 1');
    if (!$stmt) { echo 'Erro no prepare: ' . $conn->error; exit; }
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $res = $stmt->get_result();
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        $codigo_1 = intval($row['codigo_1']);
        $codigo_2 = intval($row['codigo_2']);
        $codigo_3 = intval($row['codigo_3']);
        $codigo_4 = intval($row['codigo_4']);
        $codigo_5 = intval($row['codigo_5']);
        $codigo_6 = intval($row['codigo_6']);
    }
    echo "<div class='felixCentro'> 
         <div class='mensagemCodigo'> 
                <p>O código enviado ao seu email é: $codigo_1 $codigo_2 $codigo_3 $codigo_4 $codigo_5 $codigo_6</p>
                <a href='' class='fechar'>Fechar</a>
                </div>
        </div>";
    



?>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../../style/style.css">
    <title>Verificação de 2 etapas</title>
</head>

<body>
    <header class="headerAzulLogo">
        <img id="ajusteImagem" src="../../../../assets/logos/logoPequena.png" alt="Logo Pequena">
    </header>
    <a href="../../../admin/config/configAdmin.php">
        <img src="../../../../assets/icons/header/setaEsquerdaClara.PNG" alt="Seta" onclick="voltarPagina()">
    </a>
    <div class="tituloAzul">
        <h1>Verificação de 2 etapas</h1>
        <br>
    </div>
    <main>
        <br>
        <br>
        <br>
        <div class="container">
            <form method="POST" action="">
                <div class="grupoInputs">
                    <input type="number" name="numero1" class="otp" maxlength="1" inputmode="numeric" autocomplete="one-time-code" required>
                    <input type="number" name="numero2" class="otp" maxlength="1" inputmode="numeric" autocomplete="one-time-code" required>
                    <input type="number" name="numero3" class="otp" maxlength="1" inputmode="numeric" autocomplete="one-time-code" required>
                    <input type="number" name="numero4" class="otp" maxlength="1" inputmode="numeric" autocomplete="one-time-code" required>
                    <input type="number" name="numero5" class="otp" maxlength="1" inputmode="numeric" autocomplete="one-time-code" required>
                    <input type="number" name="numero6" class="otp" maxlength="1" inputmode="numeric" autocomplete="one-time-code" required>
                </div>
                <h2 class="tituloAzul">
                    Um código de verificação foi enviado para o seu email. Insira o código para continuar.
                </h2>
                
                <div class="flexCentro">
                    <button class="ativo" type="submit" name="verificar">Verificar</button>
                   
                </div>
            </form>
        <form action="" method="post">
        <button class="ativo" type="submit" name="reenviar">Reenviar código</button></form>
        </div>
    </main>
    <div class="espacoFooterAzul"></div>
    <footer class="footerAzulArredondado">

    </footer>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.fechar').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var mensagem = btn.closest('.mensagemCodigo') || btn.closest('.mensagemErro');
                if(mensagem) mensagem.remove();
            });
        });
    });
    // Seleciona todos os inputs do código (coloque essa classe nos inputs)
const inputs = Array.from(document.querySelectorAll('input.otp'));

if (inputs.length) {
  // coloca o cursor no primeiro ao carregar (opcional)
  inputs[0].focus();

  inputs.forEach((input, idx) => {
    // só permitir dígitos
    input.addEventListener('input', (e) => {
      const val = e.target.value;
      // remove tudo que não seja dígito
      const digit = val.replace(/\D/g, '');
      e.target.value = digit;

      if (digit.length === 1) {
        // ir para o próximo input, se houver
        const next = inputs[idx + 1];
        if (next) {
          next.focus();
          next.select && next.select();
        }
      }
    });

    // Backspace: se campo vazio, volta para o anterior
    input.addEventListener('keydown', (e) => {
      if (e.key === 'Backspace' && !e.target.value) {
        const prev = inputs[idx - 1];
        if (prev) {
          prev.focus();
          // prev.value = ''; // opcional limpar
        }
      }
      // opcional: permitir apenas números, backspace, seta esquerda/direita, tab
      // if (!/^[0-9]$/.test(e.key) && !['Backspace','ArrowLeft','ArrowRight','Tab'].includes(e.key)) {
      //   e.preventDefault();
      // }
    });

    // Suporte a colar: distribui os caracteres colados nos inputs a partir deste
    input.addEventListener('paste', (e) => {
      e.preventDefault();
      const paste = (e.clipboardData || window.clipboardData).getData('text');
      const digits = paste.replace(/\D/g, '').split('');
      if (digits.length === 0) return;
      for (let i = 0; i < digits.length && (idx + i) < inputs.length; i++) {
        inputs[idx + i].value = digits[i];
      }
      const nextIndex = Math.min(inputs.length - 1, idx + digits.length);
      inputs[nextIndex].focus();
    });

    // comportamento visual: ao focar, selecionar o conteúdo para que digitação sobrescreva
    input.addEventListener('focus', (e) => e.target.select());
  });
}
    </script>
</body>

</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){       
    if(isset($_POST['reenviar'])){

        
        $numero1 = rand(0, 9);
        $numero2 = rand(0, 9);
        $numero3 = rand(0, 9);
        $numero4 = rand(0, 9);
        $numero5 = rand(0, 9);
        $numero6 = rand(0, 9);

        $sql = "UPDATE codigos SET codigo_1=$numero1, codigo_2=$numero2, codigo_3=$numero3, codigo_4=$numero4, codigo_5=$numero5, codigo_6=$numero6 WHERE id=?";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->close();

        echo "<div class='mensagemCodigo'> <p>Código reenviado para seu email.</p><a href='' class='fechar'>Fechar</a></div>";


    } elseif(isset($_POST['verificar'])) {
        $temFTA = $_POST["temFTA"] ?? "";
        $boolean = 1;
        if($numero1 == $codigo_1 && $numero2 == $codigo_2 && $numero3 == $codigo_3 && $numero4 == $codigo_4 && $numero5 == $codigo_5 && $numero6 == $codigo_6){
            $stmt3 = $conn->prepare("UPDATE usuarios SET temTFA=? WHERE id=?");
            $stmt3->bind_param("ii", $boolean, $id);
            $stmt3->execute();
            $stmt3->close();
            echo "<div class='mensagemCodigo'> 
            <p>Código de verificação de duas etapas aplicado com sucesso.</p>
            <a href='../../../admin/config/configAdmin.php' class='fecharr'>Voltar para as configurações</a>
            </div>";
            exit;
        }else{
            echo "<div class='mensagemErro'> 
            <p>Código incorreto.</p>
            <a href='' class='fechar'>Fechar</a>
                </div>";
        }
    }
}
?>