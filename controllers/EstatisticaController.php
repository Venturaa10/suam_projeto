<?php
require_once __DIR__ . '/../models/Database.php';

class EstatisticaController {
    public static function obterEstatisticas() {
        $conn = Database::getConnection();
        $sql = "SELECT COUNT(*) as total_resultados, AVG(pontos) as media_pontos FROM pontuacao";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public static function obterEstatisticaPorCPF($cpf) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT nome, COUNT(*) as quantidade, AVG(pontos) as media FROM pontuacao WHERE cpf = ? GROUP BY nome LIMIT 1");
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        
        $resultado = $stmt->get_result()->fetch_assoc();
        if ($resultado && $resultado['quantidade'] > 0) {
            return $resultado;
        }

        
        return null;
    }
}
?>
