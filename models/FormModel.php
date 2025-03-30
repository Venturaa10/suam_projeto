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
        
        if ($stmt->execute()) {
            // Retorna o id do estudante recém-criado
            return $conn->insert_id;
        } else {
            return false;
        }
    }

    public static function getEstudanteById($estudante_id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT id, nome, email, cpf FROM estudante WHERE id = ?");
        $stmt->bind_param("i", $estudante_id); // Usando "i" para o tipo inteiro
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Verifica se encontrou algum resultado
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Retorna os dados do estudante
        } else {
            return null; // Caso o estudante não seja encontrado
        }
    }
    
    
}