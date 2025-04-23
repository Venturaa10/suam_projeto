<?php
session_start();
header('Content-Type: application/json');
require_once 'controllers/EstatisticaController.php';

$cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');

if (!$cpf) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Informe o CPF cadastrado no formulário.']);
    exit;
}

if (strlen($cpf) !== 11) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'O CPF deve conter exatamente 11 números.']);
    exit;
}

$resultado = EstatisticaController::obterEstatisticaPorCPF($cpf);

if ($resultado) {
    // Se existir o cpf no banco de dados, retorna os dados.
    echo json_encode(['status' => 'ok', 'dados' => $resultado, 'cpf' => $cpf]);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Nenhum resultado encontrado para este CPF.']);
}
