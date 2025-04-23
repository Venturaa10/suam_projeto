<?php

require_once 'controllers/EstatisticaController.php';
header('Content-Type: application/json');

$estatisticas = EstatisticaController::obterEstatisticas();
echo json_encode($estatisticas);
