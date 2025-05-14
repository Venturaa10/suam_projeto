<?php

require_once __DIR__ . '/../controllers/EstatisticaController.php';
header('Content-Type: application/json');

$estatisticas = EstatisticaController::obterEstatisticas();
echo json_encode($estatisticas);
