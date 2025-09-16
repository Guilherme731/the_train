<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../style/style.css">
    <script src="../../../scripts/botoesMenus.js"></script>
    <script src="../../../scripts/perfil/validarEditarPerfilUsuario.js"></script>
    <title>Editar Perfil De Usuário</title>
</head>

<body>
    <header class="headerAzulVoltar">
        <img src="../../../assets/icons/header/setaEsquerda.png" alt="Seta" onclick="voltarPagina()">
    </header>

    <main>
        <div class="gridCentro">

            <h2 class="tituloAzul">Editar Perfil De Usuário</h2>

            <img id="imagemUsuario" src="../../../assets/icons/config/funcionarioIcone.png" alt="Icone do funcionario">

            <h3 class="textoCentral">Nome do Usuário</h3>
        </div>

        <form id="formularioEditarPerfilUsuario">
        <div id="centroPerfil">
            <div class="flexCentro">
                <div id="informacoesEspeciaisUser">
                    <div class="marginTopDown-2">
                      <input type="text" name="cargo" id="cargo" class="informacoesEspeciais" placeholder="Cargo"><br>
                      <div class="error" id="erroCargo"></div>
                    </div>
                      
                    <div class="marginTopDown-2">
                      <input type="text" name="CPF" id="cpf" class="informacoesEspeciais" placeholder="CPF"><br>
                      <div class="error" id="erroCPF"></div>
                    </div>
                      
                  <div class="marginTopDown-2">
                      <input type="text" name="email" id="email" class="informacoesEspeciais" placeholder="E-mail"><br>
                      <div class="error" id="erroEmail"></div>
                  </div>
      
                  <div class="marginTopDown-2">
                      <input type="text" name="nomeUsuario" id="nomeUsuario" class="informacoesEspeciais" placeholder="Nome de Usuário">
                      <div class="error" id="erroNomeUsuario"></div>
                  </div>

                  <div class="marginTopDown-2">
                      <input type="text" name="senha" id="senhaUsuario" class="informacoesEspeciais" placeholder="Senha">
                      <div class="error" id="erroSenha"></div>
                  </div>

                  <div class="marginTopDown-2">
                      <input type="text" name="salario" id="salarioUsuario" class="informacoesEspeciais" placeholder="Salário">
                      <div class="error" id="erroSalario"></div>
                  </div>
      
                  </div>
              </div>
            </div>
        
            <div id="espacoButton">
                    <input type="submit" id="botaoSalvarEditarPerfil" value="Salvar">
            </div>
    </form>    
    </main>
    <div class="espacoFooterAzulLogo"></div>
    <footer class="footerAzulLogo">
        <img src="../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
    
</body>

</html>