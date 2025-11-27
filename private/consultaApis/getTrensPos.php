<?php
include '../conexao/conexao.php';
date_default_timezone_set('America/Sao_Paulo');

function secondsSinceDeparture($horaSaida) {
    $tz = new DateTimeZone('America/Sao_Paulo');
    if (preg_match('/^\d{1,2}:\d{2}$/', $horaSaida)) {
        $horaSaida .= ':00';
    }
    if (!preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $horaSaida)) {
        return null;
    }

    $saidaDt = DateTime::createFromFormat('H:i:s', $horaSaida, $tz);
    if (!$saidaDt) return null;
    $now = new DateTime('now', $tz);
    $saidaDt->setDate(intval($now->format('Y')), intval($now->format('m')), intval($now->format('d')));
    return intval($now->getTimestamp()) - intval($saidaDt->getTimestamp());
}

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
        $diff = secondsSinceDeparture($horaSaida);
        if ($diff !== null) {
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
        $diff = secondsSinceDeparture($horaSaida);
        if ($diff !== null) {
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
        $diff = secondsSinceDeparture($horaSaida);
        if ($diff !== null) {
            if ($diff <= 0 || ($diff * $VEL_X) > 330) {
                $posX = 330;
            } else if (($diff * $VEL_X) <= 130) {
                $posX = (330 - ($diff * $VEL_X));
            } else {
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
        $diff = secondsSinceDeparture($horaSaida);
        if ($diff !== null) {
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
        $diff = secondsSinceDeparture($horaSaida);
        if ($diff !== null) {
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
        $diff = secondsSinceDeparture($horaSaida);
        if ($diff !== null) {
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
        $diff = secondsSinceDeparture($horaSaida);
        if ($diff !== null) {
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

    $trensPos[$i] = [$posX, $posY, $row['idTrem'], $diff];
    $i++;
}
header('Content-Type: application/json');
echo json_encode($trensPos);
