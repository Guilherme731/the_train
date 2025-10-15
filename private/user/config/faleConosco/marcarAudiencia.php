<?php
session_start();
include '../../../authGuard/authUsuario.php';
?>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../../assets/logos/logoPequena.png">
    <link rel="stylesheet" href="../../../../style/style.css">
    <title>Marcar audiência</title>
</head>

<body>
    <header class="headerAzulVoltar">
        <a href="../faleConosco/faleConosco.php">
            <a href="faleConosco.php"><img src="../../../../assets/icons/header/setaEsquerda.png" alt="Seta"></a>
        </a>
    </header>
    <div class="tituloAzul">
        <h2>Agenda de audiência</h2>
    </div>

    <fieldset class="grupo">
        <form id="check">

            <h3 class="amarelo">Horário:</h3>
            <input type="time" class="corBarra" name="horário">

            <br>

            <h3 class="amarelo">No. Audiência/Horário:</h3>
            <input type="number" class="corBarra" name="audiência/horário">
            <input type="time" class="corBarra" name="audiência/horário">

            <div>
                <h3 class="amarelo">Agendar automaticamente?:</h3>



                <input type="radio" id="tecnologia1" name="tecnologia">
                <label for="tecnologia" class="amarelo">Sim</label>

                <input type="radio" id="tecnologia2" name="tecnologia">
                <label for="tecnologia" class="amarelo">Não</label>





            </div>

            <br>
            <br>

            <button type="submit" id="adicionar">Adicionar</button>
            <button type="button" id="cancelar" onclick="cancelar()">Cancelar</button>

        </form>
    </fieldset>

    <main>

    </main>
    <footer class="footerAzulLogo">
        <img src="../../../../assets/logos/logoCompleta.png" alt="Logo">
    </footer>
    <script src="../../../../scripts/marcarAudiencia.js"></script>
    <script src="../../../../scripts/botoesMenus.js"></script>
</body>

</html>