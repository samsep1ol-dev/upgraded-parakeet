<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// Verifica se login e senha foram fornecidos via GET ou POST
if (!isset($_GET['email']) || !isset($_GET['senha'])) {
    echo json_encode(['error' => 'Email ou senha não fornecidos']);
    exit;
}

$email = $_GET['email'];
$senha = $_GET['senha'];
$token = base64_encode($email . ':' . $senha);

$tokenUrl = 'https://servicos-cloud.saude.gov.br/pni-bff/v1/autenticacao/tokenAcesso';

$ch = curl_init($tokenUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "x-authorization: Basic $token",
    "User-Agent: Mozilla/5.0"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([]));

$tokenResponse = curl_exec($ch);
if ($tokenResponse === false) {
    echo json_encode(['error' => 'Erro ao obter token de acesso']);
    exit;
}

$tokenData = json_decode($tokenResponse);
if (!isset($tokenData->accessToken)) {
    echo json_encode(['error' => 'Token de acesso não encontrado']);
    exit;
}

echo json_encode(['accessToken' => $tokenData->accessToken]);

curl_close($ch);
?>
