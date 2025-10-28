<?php

function obterDadosCep($cep){
    $api_url = "https://viacep.com.br/ws/$cep/json/";

    $response_json = @file_get_contents($api_url);

    if ($response_json === FALSE) {
        return null;
    } else {
        $data = json_decode($response_json);

        if(!isset($data->erro)){
            $dadosEndereco = [$data->logradouro, $data->localidade, $data->estado];
            return $dadosEndereco;
        }else{
            return null;
        }
    }
}

?>