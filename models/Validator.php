<?php


class Validator {

    public static function validateNome($nome) {
        /**
         * Validar o campo de nome.
         * - Verificar se o campo nome existe algum valor, ou seja, não está vazia.
         * - Regex para aceitar nomes comuns, sem numero ou caracteres especiais não permitidos.
         * 
         * function preg_match:
         *  - Verifica se o valor de 'nome' faz match (combina) com o regex.
         * 
         * Return:
         * - Retorna 'true' em caso de valor válido.
         */

        if (empty($nome)) {
            return "O nome é obrigatório.";
        }
        if (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/", $nome)) {
            return "O nome só pode conter letras, espaços e caracteres acentuados.";
        }
        return true;
    }

    public static function validateIdade($idade) {
        /**
         * Validar se o campo idade existe e se é um número inteiro.
         */

        if (empty($idade)) {
            return "A idade é obrigatória.";
        }
        if (!is_numeric($idade)) {
            return "A idade deve ser um número válido.";
        }
        return true;
    }

    public static function validateCPF($cpf) {
        /**
         * Validar o campo de CPF.
         * 
         * cpf:
         *  Remove qualquer pontuação para garantir e realizar as validações somente com os números.
         * 
         * Validações: 
         * - Verificar se o campo 
         * 
         */


         $cpf = preg_replace('/\D/', '', $cpf);

        if (empty($cpf)) {
            return "Informe um CPF válido.";
        }

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return "O CPF deve conter 11 dígitos.";
        }

        if (!self::isValidCPF($cpf)) {
            return "O CPF informado é inválido.";
        }

        return true;
    }

    // Função que verifica a validade do CPF
    private static function isValidCPF($cpf) {
        /**
         * Verifica se o CPF é válido (com base no algoritmo de validação do CPF brasileiro)
         */
        
        $cpf = preg_replace('/\D/', '', $cpf); // Remove qualquer pontuação

        // Verifica se o CPF é composto por números iguais (ex: 111.111.111-11)
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Validação do primeiro dígito
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$t] != $d) {
                return false;
            }
        }
        return true;
    }

    // Validação do email: verifica se o email está no formato correto
    public static function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Informe um endereço de email válido.";
        }
        return true;
    }

    public static function formatCPF($cpf) {
        /**
         * Função para aplicar a mascara no cpf.
         * - CPF é formatado enquanto o usuario digita.
         * 
         */

        $cpf = preg_replace('/\D/', '', $cpf);

        // Aplica a máscara de CPF (XXX.XXX.XXX-XX)
        if (strlen($cpf) == 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
        }

        return $cpf;
    }
}
