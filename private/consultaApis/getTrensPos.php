<?php
include '../conexao/conexao.php';

$sqlTrens = 'SELECT trens.id AS idTrem, trens.idEstacao AS estacaoAtual, localizacaoX, localizacaoY, horaSaida, ordemRota, trens.idRota, rotas.id, rotasEstacoes.idRota, rotasEstacoes.idEstacao AS nextStop FROM trens INNER JOIN rotas ON trens.idRota = rotas.id INNER JOIN rotasEstacoes ON rotas.id = rotasEstacoes.idRota AND ordemRota = rotasEstacoes.ordem';
$resultTrens = $conn->query($sqlTrens);

$trensPos = [];
$i = 0;

while ($row = $resultTrens->fetch_assoc()) {
    $posX = 0;
    $posY = 0;
    $VEL_X = 20;
    if ($row['nextStop'] == 3 && $row['estacaoAtual'] == 2) {


        $horaSaida = $row['horaSaida'];
        $now = new DateTime();
        if (preg_match('/^\d{1,2}:\d{2}$/', $horaSaida)) {
            $horaSaida .= ':00';
        }
        if (preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $horaSaida)) {
            list($h, $m, $s) = explode(':', $horaSaida);
            $saidaSeconds = (intval($h) + 4) * 3600 + intval($m) * 60 + intval($s);

            $now = new DateTime();
            $nowSeconds = intval($now->format('H')) * 3600 + intval($now->format('i')) * 60 + intval($now->format('s'));

            $diff = $nowSeconds - $saidaSeconds;
            $posX = $diff * $VEL_X;

            if ($posX <= 5) {
                $posX = 5;
                $posY = 65;
            } else if ($posX <= 65) {
                $posY = 65 - sqrt(3600 - (pow(($posX - 65), 2)));
            } else if ($posX > 265 && $posX < 330) {
                $posY = 65 - sqrt(3600 - (pow((($posX - 200) - 65), 2)));
            } else if ($posX >= 329) {
                $posX = 330;
                $posY = 65;
            } else {
                $posY = 5;
            }
        } else {
            $posX = 0;
        }
    }
    if ($row['nextStop'] == 2 && $row['estacaoAtual'] == 3) {


        $horaSaida = $row['horaSaida'];
        $now = new DateTime();
        if (preg_match('/^\d{1,2}:\d{2}$/', $horaSaida)) {
            $horaSaida .= ':00';
        }
        if (preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $horaSaida)) {
            list($h, $m, $s) = explode(':', $horaSaida);
            $saidaSeconds = (intval($h) + 4) * 3600 + intval($m) * 60 + intval($s);

            $now = new DateTime();
            $nowSeconds = intval($now->format('H')) * 3600 + intval($now->format('i')) * 60 + intval($now->format('s'));

            $diff = $nowSeconds - $saidaSeconds;
            $posX = (330 - $diff * $VEL_X);

            if ($posX <= 5) {
                $posX = 5;
                $posY = 65;
            } else if ($posX <= 65) {
                $posY = 65 - sqrt(3600 - (pow(($posX - 65), 2)));
            } else if ($posX > 265 && $posX < 330) {
                $posY = 65 - sqrt(3600 - (pow((($posX - 200) - 65), 2)));
            } else if ($posX >= 329) {
                $posX = 330;
                $posY = 65;
            } else {
                $posY = 5;
            }
        } else {
            $posX = 0;
        }
    }
    if ($row['nextStop'] == 3 && $row['estacaoAtual'] == 3) {


        $horaSaida = $row['horaSaida'];
        $now = new DateTime();
        if (preg_match('/^\d{1,2}:\d{2}$/', $horaSaida)) {
            $horaSaida .= ':00';
        }
        if (preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $horaSaida)) {
            list($h, $m, $s) = explode(':', $horaSaida);
            $saidaSeconds = (intval($h) + 4) * 3600 + intval($m) * 60 + intval($s);

            $now = new DateTime();
            $nowSeconds = intval($now->format('H')) * 3600 + intval($now->format('i')) * 60 + intval($now->format('s'));

            $diff = $nowSeconds - $saidaSeconds;
            if ($diff <= 0 || ($diff * $VEL_X) > 330) {
                $posX = 330;
            } else if (($diff * $VEL_X) <= 130) {
                // FASE 1: Diminuindo de 330 para 200
                // posX vai de 330 (diff=0) a 200 (diff=130)
                $posX = (330 - ($diff * $VEL_X));
            } else {
                // FASE 2: Aumentando de 200 em diante
                // O movimento de retorno deve usar (diff - 130)
                // Para retornar a 330, a lógica é: 200 + (diff - 130)
                $posX = (200 + (($diff * $VEL_X) - 130));
            }

            if ($posX <= 0) {
                $posX = 330;
                $posY = 65;
            } else if ($posX <= 265 && ($diff * $VEL_X) < 130 && $posX < 330 && $posX > 0) {
                $posY = 65 + sqrt(3600 - (pow((($posX - 200) - 65), 2)));
            } else if ($posX > 265 && ($diff * $VEL_X) < 130 && $posX < 330 && $posX > 0) {
                $posY = 65 + sqrt(3600 - (pow((($posX - 200) - 65), 2)));
            } else if ($posX <= 265 && ($diff * $VEL_X) > 130 && $posX < 330 && $posX > 0) {
                $posY = 65 - sqrt(3600 - (pow((($posX - 200) - 65), 2)));
            } else if ($posX > 265 && ($diff * $VEL_X) > 130 && $posX < 330 && $posX > 0) {
                $posY = 65 - sqrt(3600 - (pow((($posX - 200) - 65), 2)));
            } else {
                $posY = 65;
                $posX = 330;
            }
        } else {
            $posX = 0;
        }
    }
    if ($row['nextStop'] == 1 && $row['estacaoAtual'] == 2) {


        $horaSaida = $row['horaSaida'];
        $now = new DateTime();
        if (preg_match('/^\d{1,2}:\d{2}$/', $horaSaida)) {
            $horaSaida .= ':00';
        }
        if (preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $horaSaida)) {
            list($h, $m, $s) = explode(':', $horaSaida);
            $saidaSeconds = (intval($h) + 4) * 3600 + intval($m) * 60 + intval($s);

            $now = new DateTime();
            $nowSeconds = intval($now->format('H')) * 3600 + intval($now->format('i')) * 60 + intval($now->format('s'));

            $diff = $nowSeconds - $saidaSeconds;
            $posX = $diff * $VEL_X;

            if ($posX <= 5) {
                $posX = 5;
                $posY = 65;
            } else if ($posX <= 65) {
                $posY = 65 + sqrt(3600 - (pow(($posX - 65), 2)));
            } else {
                $posX = 70;
                $posY = 135;
            }
        } else {
            $posX = 0;
        }
    }
    if ($row['nextStop'] == 2 && $row['estacaoAtual'] == 1) {


        $horaSaida = $row['horaSaida'];
        $now = new DateTime();
        if (preg_match('/^\d{1,2}:\d{2}$/', $horaSaida)) {
            $horaSaida .= ':00';
        }
        if (preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $horaSaida)) {
            list($h, $m, $s) = explode(':', $horaSaida);
            $saidaSeconds = (intval($h) + 4) * 3600 + intval($m) * 60 + intval($s);

            $now = new DateTime();
            $nowSeconds = intval($now->format('H')) * 3600 + intval($now->format('i')) * 60 + intval($now->format('s'));

            $diff = $nowSeconds - $saidaSeconds;
            $posX = 70 - ($diff * $VEL_X);

            if ($posX <= 5) {
                $posX = 5;
                $posY = 65;
            } else if ($posX <= 65) {
                $posY = 65 + sqrt(3600 - (pow(($posX - 65), 2)));
            } else {
                $posX = 70;
                $posY = 135;
            }
        } else {
            $posX = 0;
        }
    }
    if ($row['nextStop'] == 1 && $row['estacaoAtual'] == 3) {


        $horaSaida = $row['horaSaida'];
        $now = new DateTime();
        if (preg_match('/^\d{1,2}:\d{2}$/', $horaSaida)) {
            $horaSaida .= ':00';
        }
        if (preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $horaSaida)) {
            list($h, $m, $s) = explode(':', $horaSaida);
            $saidaSeconds = (intval($h) + 4) * 3600 + intval($m) * 60 + intval($s);

            $now = new DateTime();
            $nowSeconds = intval($now->format('H')) * 3600 + intval($now->format('i')) * 60 + intval($now->format('s'));

            $diff = $nowSeconds - $saidaSeconds;
            $posX = 330 - ($diff * $VEL_X);

            if ($posX >= 330) {
                $posX = 330;
                $posY = 65;
            } else if ($posX >= 265) {
                $posY = 65 + sqrt(3600 - (pow(($posX - 265), 2)));
            }else if ($posX <= 70) {
                $posX = 70;
                $posY = 135;
            } else {
                $posY = 135;
            }
        } else {
            $posX = 0;
        }
    }
    if ($row['nextStop'] == 3 && $row['estacaoAtual'] == 1) {


        $horaSaida = $row['horaSaida'];
        $now = new DateTime();
        if (preg_match('/^\d{1,2}:\d{2}$/', $horaSaida)) {
            $horaSaida .= ':00';
        }
        if (preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $horaSaida)) {
            list($h, $m, $s) = explode(':', $horaSaida);
            $saidaSeconds = (intval($h) + 4) * 3600 + intval($m) * 60 + intval($s);

            $now = new DateTime();
            $nowSeconds = intval($now->format('H')) * 3600 + intval($now->format('i')) * 60 + intval($now->format('s'));

            $diff = $nowSeconds - $saidaSeconds;
            $posX = 70+($diff * $VEL_X);

            if ($posX >= 330) {
                $posX = 330;
                $posY = 65;
            } else if ($posX >= 265) {
                $posY = 65 + sqrt(3600 - (pow(($posX - 265), 2)));
            }else if ($posX <= 70) {
                $posX = 70;
                $posY = 135;
            } else {
                $posY = 135;
            }
        } else {
            $posX = 0;
        }
    }

    $trensPos[$i] = [$posX, $posY, $row['idTrem']];
    $i++;
}
header('Content-Type: application/json');
echo json_encode($trensPos);
