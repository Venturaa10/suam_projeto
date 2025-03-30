<?php
// Agora está corretamente apontando para o config.php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/Database.php';


class PontuacaoQuiz {
    public static function save($estudante_id, $nome, $email, $cpf, $pontos) {
        if ($estudante_id === null) {
            return false; // Garante que não tentaremos inserir um valor NULL
        }

        $conn = Database::getConnection();
        $sql = "INSERT INTO pontuacao (estudante_id, nome, email, cpf, pontos) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $estudante_id, $nome, $email, $cpf, $pontos); // Mudando o tipo do primeiro parâmetro para inteiro

        return $stmt->execute();
    }
}
?>
