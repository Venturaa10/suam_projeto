<?php
require_once 'Database.php';

class Estudante {
    /**
     * 
     * Summary of function save
     * @param mixed $nome - String
     * @param mixed $idade - String
     * @param mixed $cpf - String
     * @param mixed $email - String
     * @return bool
     * 
     * getConnection:
     *  - Faz a conexão com o banco de dados.
     * prepare:
     * - Preapara os dados para serem inseridos no banco de dados.
     * - VAlUES representa a quantidade de colunas que serão inseridas no banco.  
     * bind_param:
     * - Recebe o tipo de cada parametro, nesse caso "ssss" representa o tipo de cada parametro respectivamente, nesse caso, todos serão armazenados como strings. 
     * execute:
     * - Executa o comando no banco de dados.
     */


    public static function save($nome, $idade, $cpf, $email) {
        $cpf = preg_replace('/\D/', '', $cpf); // Garantir que seja salvo somente os números no banco de dados.

        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO estudante (nome, idade, cpf, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $idade, $cpf, $email);
        return $stmt->execute();
    }
}


class PontuacaoQuiz {
    public static function save($estudante_id, $pontos) {
        $conn = Database::getConnection(); // Conexão com o banco

        $stmt = $conn->prepare("INSERT INTO pontuacao (estudante_id, pontos) VALUES (?, ?)");
        $stmt->bind_param("ii", $estudante_id, $pontos); 

        return $stmt->execute();
    }

    public static function getByStudent($estudante_id) {
        $conn = Database::getConnection();

        $stmt = $conn->prepare("SELECT * FROM pontuacao WHERE estudante_id = ?");
        $stmt->bind_param("i", $estudante_id);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // Retorna todas as pontuações do estudante
    }
}
