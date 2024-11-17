<?php

// URL da API

$url = 'https://servicos-cloud.saude.gov.br/pni-bff/v1/autenticacao/tokenAcesso';


// Dados de autenticação

$email = 'crisnatally1@gmail.com';

$senha = 'MONTEALEGRE1';

$token = base64_encode($email . ':' . $senha);


// Inicializa o cURL

$ch = curl_init($url);


// Define as opç�es do cURL

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [

    "Content-Type: application/json",

    "x-authorization: Basic $token",

    "User-Agent: Mozilla/5.0"

]);

curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([]));


// Executa a requisição

$response = curl_exec($ch);


// Verifica se a requisição foi bem-sucedida

if ($response === false) {

    echo json_encode(['error' => 'Falha ao fazer a requisição']);

    exit;

}


// Decodifica a resposta JSON

$data = json_decode($response);


// Verifica se o token de acesso foi encontrado

if (!isset($data->accessToken)) {

    echo json_encode(['error' => 'Token de acesso não encontrado']);

    exit;

}


// Exibe todas as informaç�es da resposta

echo json_encode($data);


// Fecha o cURL

curl_close($ch);

?>