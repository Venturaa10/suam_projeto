<?php
// Agora está corretamente apontando para o config.php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/Database.php';


class PontuacaoQuiz {

    // Configuração para o banco de dados MySQL

    public static function save($estudante_id, $nome, $email, $cpf, $pontos) {
        /**
         * Salva todas as informações do estudante no banco de dados, junto com a sua pontuação no quiz.
         * 
         */
        if ($estudante_id === null) {
            var_dump($estudante_id); // Para depuração
            return false; // Garante que não tentaremos inserir um valor NULL
        }

        $conn = Database::getConnection();
        $sql = "INSERT INTO pontuacao (estudante_id, nome, email, cpf, pontos) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $estudante_id, $nome, $email, $cpf, $pontos); // Mudando o tipo do primeiro parâmetro para inteiro
        
        // Executa a consulta e verifica se foi bem-sucedida
        return $stmt->execute();
    }


    // Configuração para o banco de dados PostgreSQL

    // public static function save($estudante_id, $nome, $email, $cpf, $pontos) {
    //     /**
    //      * Salva todas as informações do estudante no banco de dados, junto com a sua pontuação no quiz.
    //      * 
    //      */
    //     if ($estudante_id === null) {
    //         var_dump($estudante_id); // Para depuração
    //         return false; // Garante que não tentaremos inserir um valor NULL
    //     }

    //     $conn = Database::getConnection(); // Obter a conexão com o banco PostgreSQL via PDO
    //     $sql = "INSERT INTO pontuacao (estudante_id, nome, email, cpf, pontos) 
    //             VALUES (:estudante_id, :nome, :email, :cpf, :pontos)";

    //     $stmt = $conn->prepare($sql);

    //     // Bind dos parâmetros, usando bindValue para garantir o tipo dos dados
    //     $stmt->bindValue(':estudante_id', $estudante_id, PDO::PARAM_INT);
    //     $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
    //     $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    //     $stmt->bindValue(':cpf', $cpf, PDO::PARAM_STR);
    //     $stmt->bindValue(':pontos', $pontos, PDO::PARAM_INT); // Pontuação como inteiro

    //     // Executa a consulta e verifica se foi bem-sucedida
    //     return $stmt->execute();
    // }
}

?>
