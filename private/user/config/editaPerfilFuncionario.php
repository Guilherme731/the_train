<?php
include '../../authGuard/authUsuario.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../style/style.css">
    <script src="../../../scripts/botoesMenus.js"></script>
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <title>Editar Perfil</title>
</head>

<body>
    <header class="headerAzulVoltar">
        <img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
    </header>

    <main>
        <div class="gridCentro">
            <div class="gridCentro">
                <h1 class="textoCentral">Editar Perfil</h1>

                <img id="icone" src="../../../assets/icons/config/funcionarioIcone.png" alt="Icone do funcionario">
            </div>


            <a id="trocarFoto" onclick="trocarFoto()">
                <p class="textoCentral">Trocar Foto</p>
            </a>

            <h2 class="textoCentral">Nome do Usuário</h2>

        </div>

        <div class="gridCentro">


            <form id="formularioConfgUsuario">

                <div id="informacoesPessoais">
                    <div>
                        <label for="senha"></label>
                        <input type="password" name="senha" id="senha" placeholder="Senha">
                        <div class="error" id="errorSenhaFuncionario"></div>
                    </div>

                    <p>Data De Nascimento</p>

                    <div class="flex">
                        <div>
                            <label for="dataNascimentoDia"></label>
                            <input type="text" name="Dia" id="dataNascimentoDia" placeholder="Dia">
                            <div class="error" id="errorDia"></div>
                        </div>

                        <div>
                            <label for="dataNascimentoMes"></label>
                            <input type="text" name="Mes" id="dataNascimentoMes" placeholder="Mês">
                            <div class="error" id="errorMes"></div>
                        </div>

                        <div>
                            <label for="dataNascimentoAno"></label>
                            <input type="text" name="Ano" id="dataNascimentoAno" placeholder="Ano">
                            <div class="error" id="errorAno"></div>
                        </div>

                    </div>

                    <label for="genero">
                        <select name="genero" id="generoFuncionario">
                            <option value="feminino">Feminino</option>
                            <option value="prefiroNaoDizer">Prefiro Não Dizer</option>
                            <option value="masculino">Masculino</option>
                            <option value="outro">Outro</option>
                        </select>
                    </label>
                    <div class="error" id="errorGenero"></div>


                </div>

                <button id="botaoSalvar" type="submit">
                    <h2 class="marginTop-10">Salvar</h2>
                </button>


            </form>







        </div>


    </main>

    <div class="espacoFooterAzulLogo"></div>

    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
    <script src="../../../scripts/perfil/validarConfiguracaoUsuario.js"></script>
    <script src="../../../scripts/perfil/trocarFoto.js"></script>
</body>

</html>