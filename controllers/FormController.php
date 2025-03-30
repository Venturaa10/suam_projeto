<?php

require_once __DIR__ . '/../models/FormModel.php';
require_once __DIR__ . '/../models/Validator.php';


class FormController {

    // Função para processar o formulário
    public function processForm() {
        /**
         * Função resposavel por validar e processar os dados enviados pelo formulario através do método POST.
         * 
         * if -> Verifica se o methdo de envio é "POST".
         * 
         * Os valores enviados pelo formulario são armazenados através da seguinte maneira:
         * - $nome_valor = $_POST['armazena_nome_valor'] -> Aqui o 'armazena_nome_valor' está referenciando o valor de "name" no formulario. 
         * 
         * $erros (list):
         * - Armazena as mensagens de erros retornadas pelas suas funções de validações dentro da lista.
         * - Essas mensagens serão exibidas no template do formulario.
         * 
         * Validações:
         * - Valida os dados passados via POST.
         * - O formulario é enviado quando todas as validações retornarem "true" de suas funções.
         * 
         */

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome']; 
            $idade = $_POST['idade'];
            $cpf = $_POST['cpf']; // Acessa o valor do campo de input com name="cpf" 
            $email = $_POST['email'];
            
            // Armazena os dados na sessão para manter após o redirecionamento
            $_SESSION['form_data'] = $_POST;

            // Validação
            $errors = [];

            // Validações de cada campo
            $nomeValidation = Validator::validateNome($nome);
            if ($nomeValidation !== true) {
                $errors['nome'] = $nomeValidation;
            }

            $idadeValidation = Validator::validateIdade($idade);
            if ($idadeValidation !== true) {
                $errors['idade'] = $idadeValidation;
            }

            $cpfValidation = Validator::validateCPF($cpf);
            if ($cpfValidation !== true) {
                $errors['cpf'] = $cpfValidation;
            }

            $emailValidation = Validator::validateEmail($email);
            if ($emailValidation !== true) {
                $errors['email'] = $emailValidation;
            }


                 if (empty($errors)) {
                                    /**
                 * Se não houver erros armazenados armazenados, o objeto (estudante) é criado e salvo no banco de dados.
                 * O usuario é redirecionado para a pagina de quiz.
                 * 
                 * exit -> Serve para parar a execução do código, evitando execução de código adicional sem necessidade. 
                 */
                    $model = new Estudante();
                    $estudante_id = $model->save($nome, $idade, $cpf, $email);
        
                    if ($estudante_id) {
                        // Armazena o ID do estudante na sessão
                        $_SESSION['estudante_id'] = $estudante_id;
        
                        // Redireciona para a página do quiz
                        header("Location: index.php?page=quiz");
                        exit();
                    } else {
                        $errors['general'] = "Erro ao salvar os dados!";
                    }
        
                    $_SESSION['errors'] = $errors; // Persiste as mensagens de erro para continuar sendo exibida.
                    header("Location: index.php?page=form");
                    exit();
                }
        }
    }
}