<?php
require_once __DIR__ . '/../models/Database.php';

class EstatisticaController {

    // Configuração para o banco de dados MySQL

    // public static function obterEstatisticas() {
    //     $conn = Database::getConnection();
    //     $sql = "SELECT COUNT(*) as total_resultados, AVG(pontos) as media_pontos FROM pontuacao";
    //     $result = $conn->query($sql);
    //     return $result->fetch_assoc();
    // }

    
    // public static function obterEstatisticaPorCPF($cpf) {
    //     $conn = Database::getConnection();
    //     $stmt = $conn->prepare("SELECT COUNT(*) as quantidade, AVG(pontos) as media FROM pontuacao WHERE cpf = ?");
    //     $stmt->bind_param("s", $cpf);
    //     $stmt->execute();
        
    //     $resultado = $stmt->get_result()->fetch_assoc();
    //     if ($resultado && $resultado['quantidade'] > 0) {
    //         // Retornou o resultado para a api.
    //         return $resultado;
    //     }
        
    //     return null;
    // }


    // Configuração para o banco de dados PostgreSQL

    public static function obterEstatisticas() {
        $conn = Database::getConnection();
        $sql = "SELECT COUNT(*) as total_resultados, AVG(pontos) as media_pontos FROM pontuacao";
        $stmt = $conn->query($sql); // Retorna um PDOStatement
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna array associativo
    }

    public static function obterEstatisticaPorCPF($cpf) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) as quantidade, AVG(pontos) as media FROM pontuacao WHERE cpf = :cpf");
        $stmt->bindValue(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->execute();
    
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado && $resultado['quantidade'] > 0) {
            return $resultado;
        }
    
        return null;
    }
    

//     public static function processarConsultaPorCPF(array $dados)
// {
//     if (!isset($dados['cpf'])) {
//         $_SESSION['mensagem'] = "CPF não fornecido.";
//         return;
//     }

//     $cpf = preg_replace('/\D/', '', $dados['cpf']);

//     $resultado = self::obterEstatisticaPorCPF($cpf);

//     if ($resultado) {
//         // Encontrou o cpf informado no banco, retorna o cpf com os dados do estudante.
//         $_SESSION['resultado_individual'] = $resultado;
//         $_SESSION['cpf_digitado'] = $dados['cpf']; // CPF com formatação original
//     } else {
//         // Não foi possivel encontrar o cpf informado no banco de dados de estudante.
//         $_SESSION['mensagem'] = "⚠️ Nenhum resultado encontrado para este CPF.";
//         $_SESSION['cpf_digitado'] = $dados['cpf'];
//     }
// }

}
?>
