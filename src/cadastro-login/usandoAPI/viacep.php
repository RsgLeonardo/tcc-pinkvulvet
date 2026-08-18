<?php

$address = (object)[
    'cep' => '',
    'logradouro' => '',
    'bairro' => '',
    'localidade' => '',
    'uf' => ''
];

if (isset($_POST['cep'])) {
    $cep = $_POST['cep'];
    $cep = preg_replace('/[^0-9]/', '', $cep);

    if (preg_match('/^[0-9]{5}-?[0-9]{3}$/', $cep)) {
        // chamada a api direto do site viacep
        // https://viacep.com.br/ws/01001000/json/
        $url = "https://viacep.com.br/ws/{$cep}/json/";
        $address = json_decode(file_get_contents($url));
    } else {
        $address->cep = 'CEP inválido!';
    }

    //testes
    //var_dump($address);

}
