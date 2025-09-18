<?php
session_start();
?>
<header class="headerPrincipal">
    <a href="/the_train/private/<?php if($_SESSION['tipo'] == 'admin'){echo 'admin/config/configAdmin.php';} else {echo 'user/config/configFuncionario.php';}?>"><img src="/the_train/assets/icons/header/engrenagemIcone.png" alt="Configurações"></a>
    <img src="/the_train/assets/logos/logoPequena.png" alt="Logo">
    <a href="/the_train/private/user/alertas.php"><img src="/the_train/assets/icons/header/sinoIcone.png" alt="Notificações"></a>
</header>